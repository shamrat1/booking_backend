<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mechanicIds = User::where('role','!=','admin')->select('id')->get()->pluck('id');
        $statuses = ['pending', 'in-progress', 'no-show', 'complete', 'waiting-for-parts', 'cancelled'];

        $startDate = Carbon::now()->subMonth()->startOfMonth();
        $endDate = Carbon::now()->endOfYear();

        while ($startDate->lessThanOrEqualTo($endDate)) {
            if ($startDate->isWeekday()) {
                $bookingsCount = rand(7, 15);
                for ($i = 0; $i < $bookingsCount; $i++) {
                    $start = $startDate->copy()->addHours(rand(8, 15));
                    Booking::create([
                        'booking_id' => Str::uuid(),
                        'car_make' => 'CarMake-' . rand(1, 50),
                        'car_model' => 'CarModel-' . rand(1, 50),
                        'car_year' => rand(2000, 2024),
                        'registration_plate' => strtoupper(Str::random(7)),
                        'customer_name' => fake()->name(),
                        'customer_phone' => fake()->phoneNumber(),
                        'customer_email' => fake()->email(),
                        'booking_title' => 'Service Booking ' . Str::random(3),
                        'start_datetime' => $start,
                        'end_datetime' => $start->copy()->addHours(rand(1, 3)),
                        'mechanic_id' => $mechanicIds[$i % count($mechanicIds)],
                        'created_by' => 1,
                        'status' => $statuses[array_rand($statuses)],
                    ]);
                }
            }

            $startDate->addDay();
        }
    }
}
