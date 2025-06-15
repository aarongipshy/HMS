<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\RoomType;
use App\Models\Booking;

// use Stripe\Stripe;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings=Booking::all();
        return view('booking.index',['data'=>$bookings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers=Customer::all();
        return view('booking.create',['data'=>$customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'=>'required',
            'room_id'=>'required',
            'checkin_date'=>'required',
            'checkout_date'=>'required',
            'total_adults'=>'required',
            'roomprice'=>'required',
        ]);
    
        if ($request->ref == 'front') {
            // Save booking data to session
            $sessionData = [
                'customer_id' => $request->customer_id,
                'room_id' => $request->room_id,
                'checkin_date' => $request->checkin_date,
                'checkout_date' => $request->checkout_date,
                'total_adults' => $request->total_adults,
                'total_children' => $request->total_children,
                'roomprice' => $request->roomprice,
                'ref' => $request->ref
            ];
            session($sessionData);
    
            // Generate QR code content (you could also use a URL to an API endpoint or your own payment logic)
            $qrText = 'Pay $' . $request->roomprice . ' to Phone Number: 012345678 (or e-wallet, bank, etc.)';
    
            return view('booking.qrcode', ['qrText' => $qrText]);
        } else {
            // Admin booking directly stored
            $data = new Booking;
            $data->customer_id = $request->customer_id;
            $data->room_id = $request->room_id;
            $data->checkin_date = $request->checkin_date;
            $data->checkout_date = $request->checkout_date;
            $data->total_adults = $request->total_adults;
            $data->total_children = $request->total_children;
            $data->ref = 'admin';
            $data->save();
    
            return redirect('admin/booking/create')->with('success', 'Data has been added.');
        }
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Booking::where('id',$id)->delete();
        return redirect('admin/booking')->with('success','Data has been deleted.');
    }


    // Check Avaiable rooms
    function available_rooms(Request $request,$checkin_date){
        $arooms=DB::SELECT("SELECT * FROM rooms WHERE id NOT IN (SELECT room_id FROM bookings WHERE '$checkin_date' BETWEEN checkin_date AND checkout_date)");

        $data=[];
        foreach($arooms as $room){
            $roomTypes=RoomType::find($room->room_type_id);
            $data[]=['room'=>$room,'roomtype'=>$roomTypes];
        }

        return response()->json(['data'=>$data]);
    }

    public function front_booking()
    {
        return view('front-booking');
    }

    function booking_payment_success(Request $request){
       

            // $data->save();
            return view('booking.success');
        
    }

    function booking_payment_fail(Request $request){
        return view('booking.failure');
    }
}