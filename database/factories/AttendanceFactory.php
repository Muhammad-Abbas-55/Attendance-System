<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Attendance::class;

    // Keep track of the current date in the sequence
    protected static $currentDate;

    public function definition()
    {
        // Initialize the starting date if not already set (e.g., 01-09-2024)
        if (is_null(static::$currentDate)) {
            static::$currentDate = Carbon::create(2024, 9, 1); // Start date: 01-09-2024
        }

        // Assign the current date
        $date = static::$currentDate->toDateString();

        // Increment the date for the next record
        static::$currentDate->addDay();

        return [
            'date' => $date, // Sequential date
            'status' => $this->faker->randomElement(['Present', 'Absent', 'Approved Leave']),
            'user_id' => User::factory(), // Associate with a user
        ];
    }
    }
