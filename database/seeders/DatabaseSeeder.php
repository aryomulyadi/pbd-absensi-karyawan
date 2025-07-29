<?php

namespace Database\Seeders;

use App\Models\Barcode;
use App\Models\Division;
use App\Models\Education;
use App\Models\JobTitle;
use App\Models\Shift;
use App\Models\User;
use Database\Factories\DivisionFactory;
use Database\Factories\EducationFactory;
use Database\Factories\JobTitleFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed admin user
        $this->call(AdminSeeder::class);

        // Tambahkan 50 user tambahan
        User::factory(50)->create();

        // Seed divisions
        foreach (DivisionFactory::$divisions as $value) {
            Division::firstOrCreate(['name' => $value]);
        }

        // Seed educations
        foreach (EducationFactory::$educations as $value) {
            Education::firstOrCreate(['name' => $value]);
        }

        // Seed job titles
        foreach (JobTitleFactory::$jobTitles as $value) {
            JobTitle::firstOrCreate(['name' => $value]);
        }

        // Tambah barcode (misal 10 lokasi absensi)
        Barcode::factory(10)->create();

        // Tambah shift (misal 3 shift: pagi, siang, malam)
        Shift::factory(3)->create();

        // Panggil attendance seeder
        $this->call(AttendanceSeeder::class);
    }
}
