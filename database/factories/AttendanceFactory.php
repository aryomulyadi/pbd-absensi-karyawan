<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\User;
use App\Models\Shift;
use App\Models\Barcode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    public function definition(): array
    {
        // Default: tidak hadir
        return [
            'user_id' => User::inRandomOrder()->first()?->id,
            'date' => $this->faker->dateTimeBetween('2024-01-01', '2025-12-31')->format('Y-m-d'),
            'status' => 'absent',
            'note' => null,
            'time_in' => null,
            'time_out' => null,
            'barcode_id' => null,
            'shift_id' => null,
            'latitude' => null,
            'longitude' => null,
        ];
    }

    public function absent(): static
    {
        return $this->state([
            'status' => 'absent',
        ]);
    }

    public function present(bool $late = false): static
    {
        return $this->state(function () use ($late) {
            $barcode = Barcode::inRandomOrder()->first();
            $shift = Shift::inRandomOrder()->first();

            // Handle jika data barcode/shift belum tersedia
            if (!$barcode || !$shift) {
                return [];
            }

            $start = Carbon::parse($shift->start_time);
            $end = Carbon::parse($shift->end_time);

            $timeIn = $late
                ? $start->copy()->addMinutes(rand(1, 15))->toTimeString()
                : $start->copy()->subMinutes(rand(0, 15))->toTimeString();

            $timeOut = $end->copy()->addMinutes(rand(0, 15))->toTimeString();

            return [
                'status' => $late ? 'late' : 'present',
                'note' => null,
                'time_in' => $timeIn,
                'time_out' => $timeOut,
                'barcode_id' => $barcode->id,
                'shift_id' => $shift->id,
                'latitude' => $barcode->latitude,
                'longitude' => $barcode->longitude,
            ];
        });
    }

    public function excused(bool $sick = false): static
    {
        return $this->state([
            'status' => $sick ? 'sick' : 'excused',
            'note' => $this->faker->sentence(),
            'attachment' => $this->faker->imageUrl(),
        ]);
    }
}
