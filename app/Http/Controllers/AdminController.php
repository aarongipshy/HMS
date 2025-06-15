<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Booking;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    // Login
    function login(){
        return view('login');
    }
    // Check Login
    function check_login(Request $request){
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ]);
        $admin=Admin::where(['username'=>$request->username,'password'=>sha1($request->password)])->count();
        if($admin>0){
            $adminData=Admin::where(['username'=>$request->username,'password'=>sha1($request->password)])->get();
            session(['adminData'=>$adminData]);

            if($request->has('rememberme')){
                Cookie::queue('adminuser',$request->username,1440);
                Cookie::queue('adminpwd',$request->password,1440);
            }

            return redirect('admin');
        }else{
            return redirect('admin/login')->with('msg','Invalid username/Password!!');
        }
    }
    // Logout
    function logout(){
        session()->forget(['adminData']);
        return redirect('admin/login');
    }

    function dashboard(){
        $bookings=Booking::selectRaw('count(id) as total_bookings,checkin_date')->groupBy('checkin_date')->get();
        $labels=[];
        $data=[];
        foreach($bookings as $booking){
            $labels[]=$booking['checkin_date'];
            $data[]=$booking['total_bookings'];
        }

        // For Pie Chart
        $rtbookings=DB::table('room_types as rt')
            ->join('rooms as r','r.room_type_id','=','rt.id')
            ->join('bookings as b','b.room_id','=','r.id')
            ->select('rt.*','r.*','b.*',DB::raw('count(b.id) as total_bookings'))
            ->groupBy('r.room_type_id')
            ->get();
        $plabels=[];
        $pdata=[];
        foreach($rtbookings as $rbooking){
            $plabels[]=$rbooking->detail;
            $pdata[]=$rbooking->total_bookings;
        }
        // End

        // echo '<pre>';
        // print_r($rtbookings);

        return view('dashboard',['labels'=>$labels,'data'=>$data,'plabels'=>$plabels,'pdata'=>$pdata]);
    }

    public function testimonials()
    {
        $data=Testimonial::all();
        return view('admin_testimonials',['data'=>$data]);
    }

    public function destroy_testimonial($id)
    {
       Testimonial::where('id',$id)->delete();
       return redirect('admin/testimonials')->with('success','Data has been deleted.');
    }

    // បន្ថែមមុខងារទាំងនេះទៅក្នុងថ្នាក់ AdminController ដែលមានស្រាប់
    
    // បង្ហាញប្រវត្តិរូបអ្នកគ្រប់គ្រង
    public function profile()
    {
        $adminData = session('adminData')[0];
        $admin = Admin::find($adminData->id);
        return view('admin.profile.show', ['admin' => $admin]);
    }
    
    // បង្ហាញទម្រង់កែប្រែប្រវត្តិរូប
    public function editProfile()
    {
        $adminData = session('adminData')[0];
        $admin = Admin::find($adminData->id);
        return view('admin.profile.edit', ['admin' => $admin]);
    }
    
    // ធ្វើបច្ចុប្បន្នភាពប្រវត្តិរូប
    public function updateProfile(Request $request)
    {
        $adminData = session('adminData')[0];
        $admin = Admin::find($adminData->id);
        
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'address' => 'required',
        ]);
        
        // ដំណើរការរូបថត
        if($request->hasFile('photo')) {
            $imgPath = $request->file('photo')->store('public/admin');
            $imgPath = str_replace('public/', '', $imgPath);
            
            // លុបរូបថតចាស់បើមាន
            if($admin->photo && file_exists(public_path('storage/'.$admin->photo))) {
                unlink(public_path('storage/'.$admin->photo));
            }
        } else {
            $imgPath = $admin->photo;
        }
        
        // ធ្វើបច្ចុប្បន្នភាពទិន្នន័យអ្នកគ្រប់គ្រង
        $admin->full_name = $request->full_name;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        $admin->address = $request->address;
        $admin->photo = $imgPath;
        $admin->save();
        
        // ធ្វើបច្ចុប្បន្នភាពទិន្នន័យសម័យ
        $adminData = Admin::where('id', $admin->id)->get();
        session(['adminData' => $adminData]);
        
        return redirect('admin/profile')->with('success', 'ប្រវត្តិរូបត្រូវបានធ្វើបច្ចុប្បន្នភាព។');
    }
    
    // បង្ហាញទម្រង់ប្តូរពាក្យសម្ងាត់
    public function changePassword()
    {
        return view('admin.profile.change-password');
    }
    
    // ធ្វើបច្ចុប្បន្នភាពពាក្យសម្ងាត់
    public function updatePassword(Request $request)
    {
        $adminData = session('adminData')[0];
        $admin = Admin::find($adminData->id);
        
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        
        // ពិនិត្យពាក្យសម្ងាត់បច្ចុប្បន្ន
        if(sha1($request->current_password) != $admin->password) {
            return redirect('admin/change-password')->with('error', 'ពាក្យសម្ងាត់បច្ចុប្បន្នមិនត្រឹមត្រូវទេ។');
        }
        
        // ធ្វើបច្ចុប្បន្នភាពពាក្យសម្ងាត់
        $admin->password = sha1($request->password);
        $admin->save();
        
        // ធ្វើបច្ចុប្បន្នភាពទិន្នន័យសម័យ
        $adminData = Admin::where('id', $admin->id)->get();
        session(['adminData' => $adminData]);
        
        return redirect('admin/profile')->with('success', 'ពាក្យសម្ងាត់ត្រូវបានធ្វើបច្ចុប្បន្នភាព។');
    }
}