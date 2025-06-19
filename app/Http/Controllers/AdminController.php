<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    // Login
    public function login()
    {
        // Check if already logged in
        if (session('adminData')) {
            return redirect('admin');
        }

        return view('login');
    }

    // Check Login
    public function check_login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            Log::info('Login attempt for username: ' . $request->username);

            // Get admin by username
            $admin = Admin::where('username', $request->username)->first();

            if ($admin) {
                // Check if password matches SHA1 or bcrypt
                $isValidPassword = false;

                if ($admin->password === sha1($request->password)) {
                    $isValidPassword = true; // Old SHA1
                } elseif (Hash::check($request->password, $admin->password)) {
                    $isValidPassword = true; // New bcrypt
                }

                if ($isValidPassword) {
                    // Store admin in session
                    session(['adminData' => [$admin]]);
                    Log::info('User logged in successfully: ' . $admin->username);

                    // Handle remember me
                    if ($request->has('rememberme')) {
                        Cookie::queue('adminuser', $request->username, 1440);
                        Cookie::queue('adminpwd', encrypt($request->password), 1440); // Encrypt password
                    }

                    return redirect('admin')->with('success', 'Login successful!');
                }
            }

            // If login fails
            Log::warning('Failed login attempt for username: ' . $request->username);
            return redirect('admin/login')->with('msg', 'Invalid username or password!');
        } catch (\Exception $e) {
            Log::error('Login error: ' . $e->getMessage());
            return redirect('admin/login')->with('msg', 'An error occurred during login. Please try again.');
        }
    }


    // Logout
    public function logout()
    {
        session()->forget(['adminData']);
        Cookie::forget('adminuser');
        Cookie::forget('adminpwd');

        return redirect('admin/login')->with('success', 'Logged out successfully!');
    }

    public function dashboard()
    {
        // Check if user is logged in
        if (!session('adminData')) {
            return redirect('admin/login');
        }

        try {
            $bookings = Booking::selectRaw('count(id) as total_bookings, checkin_date')
                ->groupBy('checkin_date')
                ->orderBy('checkin_date')
                ->get();

            $labels = [];
            $data = [];
            foreach ($bookings as $booking) {
                $labels[] = $booking->checkin_date;
                $data[] = $booking->total_bookings;
            }

            // For Pie Chart
            $rtbookings = DB::table('room_types as rt')
                ->join('rooms as r', 'r.room_type_id', '=', 'rt.id')
                ->join('bookings as b', 'b.room_id', '=', 'r.id')
                ->select('rt.*', 'r.*', 'b.*', DB::raw('count(b.id) as total_bookings'))
                ->groupBy('r.room_type_id')
                ->get();

            $plabels = [];
            $pdata = [];
            foreach ($rtbookings as $rbooking) {
                $plabels[] = $rbooking->detail ?? 'Unknown';
                $pdata[] = $rbooking->total_bookings;
            }

            return view('dashboard', [
                'labels' => $labels,
                'data' => $data,
                'plabels' => $plabels,
                'pdata' => $pdata
            ]);
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            return view('dashboard', [
                'labels' => [],
                'data' => [],
                'plabels' => [],
                'pdata' => []
            ])->with('error', 'Error loading dashboard data.');
        }
    }

    public function testimonials()
    {
        if (!session('adminData')) {
            return redirect('admin/login');
        }

        try {
            $data = Testimonial::all();
            return view('admin_testimonials', ['data' => $data]);
        } catch (\Exception $e) {
            Log::error('Testimonials error: ' . $e->getMessage());
            return view('admin_testimonials', ['data' => collect()])->with('error', 'Error loading testimonials.');
        }
    }

    public function destroy_testimonial($id)
    {
        if (!session('adminData')) {
            return redirect('admin/login');
        }

        try {
            $testimonial = Testimonial::find($id);
            if ($testimonial) {
                $testimonial->delete();
                return redirect('admin/testimonials')->with('success', 'Testimonial deleted successfully.');
            } else {
                return redirect('admin/testimonials')->with('error', 'Testimonial not found.');
            }
        } catch (\Exception $e) {
            Log::error('Delete testimonial error: ' . $e->getMessage());
            return redirect('admin/testimonials')->with('error', 'Error deleting testimonial.');
        }
    }

    // Show admin profile
    public function profile()
    {
        if (!session('adminData')) {
            return redirect('admin/login');
        }

        try {
            $adminData = session('adminData')[0];
            $admin = Admin::find($adminData->id);

            if (!$admin) {
                return redirect('admin/login')->with('msg', 'Admin not found.');
            }

            return view('admin.profile.show', ['admin' => $admin]);
        } catch (\Exception $e) {
            Log::error('Profile error: ' . $e->getMessage());
            return redirect('admin')->with('error', 'Error loading profile.');
        }
    }

    // Show edit profile form
    public function editProfile()
    {
        if (!session('adminData')) {
            return redirect('admin/login');
        }

        try {
            $adminData = session('adminData')[0];
            $admin = Admin::find($adminData->id);

            if (!$admin) {
                return redirect('admin/login')->with('msg', 'Admin not found.');
            }

            return view('admin.profile.edit', ['admin' => $admin]);
        } catch (\Exception $e) {
            Log::error('Edit profile error: ' . $e->getMessage());
            return redirect('admin/profile')->with('error', 'Error loading edit form.');
        }
    }

    // Update profile
    public function updateProfile(Request $request)
    {
        if (!session('adminData')) {
            return redirect('admin/login');
        }

        try {
            $adminData = session('adminData')[0];
            $admin = Admin::find($adminData->id);

            if (!$admin) {
                return redirect('admin/login')->with('msg', 'Admin not found.');
            }

            $request->validate([
                'full_name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:admins,email,' . $admin->id,
                'mobile' => 'required|string|max:20',
                'address' => 'required|string|max:500',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Handle photo upload
            $imgPath = $admin->photo;
            if ($request->hasFile('photo')) {
                // Delete old photo if exists
                if ($admin->photo && Storage::disk('public')->exists($admin->photo)) {
                    Storage::disk('public')->delete($admin->photo);
                }

                // Store new photo
                $imgPath = $request->file('photo')->store('admin', 'public');
            }

            // Update admin data
            $admin->update([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'photo' => $imgPath,
            ]);

            // Update session data
            $adminData = Admin::where('id', $admin->id)->get();
            session(['adminData' => $adminData]);

            return redirect('admin/profile')->with('success', 'Profile updated successfully.');
        } catch (\Exception $e) {
            Log::error('Update profile error: ' . $e->getMessage());
            return redirect('admin/profile/edit')->with('error', 'Error updating profile.');
        }
    }

    // Show change password form
    public function changePassword()
    {
        if (!session('adminData')) {
            return redirect('admin/login');
        }

        return view('admin.profile.change-password');
    }

    // Update password
    public function updatePassword(Request $request)
    {
        if (!session('adminData')) {
            return redirect('admin/login');
        }

        try {
            $adminData = session('adminData')[0];
            $admin = Admin::find($adminData->id);

            if (!$admin) {
                return redirect('admin/login')->with('msg', 'Admin not found.');
            }

            $request->validate([
                'current_password' => 'required|string',
                'password' => 'required|string|min:6|confirmed',
            ]);

            // Check current password (support both SHA1 and Hash)
            $currentPasswordValid = false;
            if (sha1($request->current_password) === $admin->password) {
                $currentPasswordValid = true;
            } elseif (Hash::check($request->current_password, $admin->password)) {
                $currentPasswordValid = true;
            }

            if (!$currentPasswordValid) {
                return redirect('admin/change-password')->with('error', 'Current password is incorrect.');
            }

            // Update password with secure hashing
            $admin->password = Hash::make($request->password);
            $admin->save();

            // Update session data
            $adminData = Admin::where('id', $admin->id)->get();
            session(['adminData' => $adminData]);

            return redirect('admin/profile')->with('success', 'Password updated successfully.');
        } catch (\Exception $e) {
            Log::error('Update password error: ' . $e->getMessage());
            return redirect('admin/change-password')->with('error', 'Error updating password.');
        }
    }

    // Test database connection (for debugging)
    public function testDb()
    {
        try {
            DB::connection()->getPdo();
            $adminCount = Admin::count();
            return response()->json([
                'status' => 'success',
                'message' => 'Database connected successfully',
                'admin_count' => $adminCount
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Database connection failed: ' . $e->getMessage()
            ]);
        }
    }
    public function forgotPassword()
    {
        return view('admin.profile.forgot-password');
    }
}
