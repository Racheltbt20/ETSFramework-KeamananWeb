<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student = [
            [
                'nama' => 'Rachel Tabita',
                'npm' => '24081010189',
                'prodi' => 'informatika'
            ],
            [
                'nama' => 'Unsiyah',
                'npm' => '24081010098',
                'prodi' => 'informatika'
            ],
        ];
        DB::table('students')->insert($student);
    }
}
