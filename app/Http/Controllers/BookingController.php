<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller {

    public function index(Request $request) {
        $user = auth('api')->user();
        $start = $request->start ?? now()->startOfMonth();
        $end = $request->end ?? now()->endOfMonth();
        if($user->role == 'admin'){
            return Booking::orderBy('created_at','desc')->whereBetween('start_datetime',[$start,$end])->get();

        }else{
            return Booking::where('mechanic_id', auth()->id())
            ->whereBetween('start_datetime',[$start,$end])
            ->orderBy('created_at','desc')
            ->get();
        }
    }
    public function getMechanics() {
        return User::where('role','mechanic')->get();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'car_make' => 'required|string',
            'car_model' => 'required|string',
            'car_year' => 'required|integer',
            'registration_plate' => 'required|string',
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'customer_email' => 'required|string|email',
            'booking_title' => 'required|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date',
            'mechanic_id' => 'required|exists:users,id',
        ]);
        $validated['start_datetime'] = Carbon::parse($request->start_datetime);
        $validated['end_datetime'] = Carbon::parse($request->start_datetime);
        $booking = Booking::create(array_merge($validated, ['created_by' => auth()->id(),'booking_id' => $this->generateRandomString(6)]));
        return response()->json($booking, 201);
    }

    public static function generateRandomString($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = substr(str_shuffle($characters), 0, $length);

        return $randomString;
    }
    
    public function update(Request $request,int $bookingID) {
        
        $validated = $request->validate([
            'car_make' => 'required|string',
            'car_model' => 'required|string',
            'car_year' => 'required|integer',
            'registration_plate' => 'required|string',
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'customer_email' => 'required|string|email',
            'booking_title' => 'required|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date',
            'mechanic_id' => 'required|exists:users,id',
        ]);
        $booking = Booking::find($bookingID);
        $booking->update($validated);
        return response()->json($booking, 200);
    }

    public function mechanicBookings() {
        return Booking::where('mechanic_id', auth()->id())->get();
    }
}

