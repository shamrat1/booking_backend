<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $user = auth('api')->user();
        $admin = $user->role == "admin";
        $data = [];
        if($admin){
            $data['mechanics'] = User::where('role','mechanic')->count();
            $data['completed'] = Booking::where('status','complete')->count();
            $data['pending'] = Booking::where('status','pending')->count();
            $data['waiting-for-parts'] = Booking::where('status','waiting-for-parts')->count();
            $data['in-progress'] = Booking::where('status','in-progress')->count();
            $data['no-show'] = Booking::where('status','no-show')->count();
            $data['cancelled'] = Booking::where('status','cancelled')->count();
        }else{
            $data['completed'] = Booking::where('status','complete')->where('mechanic_id',$user->id)->count();
            $data['pending'] = Booking::where('status','pending')->where('mechanic_id',$user->id)->count();
            $data['waiting-for-parts'] = Booking::where('status','waiting-for-parts')->where('mechanic_id',$user->id)->count();
            $data['in-progress'] = Booking::where('status','in-progress')->where('mechanic_id',$user->id)->count();
            $data['no-show'] = Booking::where('status','no-show')->where('mechanic_id',$user->id)->count();
            $data['cancelled'] = Booking::where('status','cancelled')->where('mechanic_id',$user->id)->count();
        }
        return response()->json($data);
    }
}
