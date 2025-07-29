<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        // 3000 hadir tepat waktu
        Attendance::factory()->count(3000)->present(false)->create();

        // 2000 hadir terlambat
        Attendance::factory()->count(2000)->present(true)->create();

        // 1500 izin
        Attendance::factory()->count(1500)->excused(false)->create();

        // 1500 sakit
        Attendance::factory()->count(1500)->excused(true)->create();

        // 2000 tidak hadir
        Attendance::factory()->count(2000)->absent()->create();
    }
}
