<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'booking_id',
        'car_make',
        'car_model',
        'car_year',
        'registration_plate',
        'customer_name',
        'customer_phone',
        'customer_email',
        'booking_title',
        'start_datetime',
        'end_datetime',
        'mechanic_id',
        'created_by',
        'status',
    ];

    protected $casts = [
        'start_datetime' => 'datetime:Y-m-d H:i',
        'end_datetime' => 'datetime:Y-m-d H:i',
    ];

    protected $with = ['mechanic','admin'];

    public function mechanic(){
        return $this->belongsTo(User::class,'mechanic_id');
    }

    public function admin(){
        return $this->belongsTo(User::class,'created_by');
    }
}
