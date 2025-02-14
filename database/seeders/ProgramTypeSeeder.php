<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('program_types')->insert([
            ["title" => "college"],
            ["title" => "certificate"],
            ["title" => "masteral"],
            ["title" => "law"],
            ["title" => "doctoral"],
            ["title" => "prep"],
            ["title" => "grade school"],
            ["title" => "high school"],
            ["title" => "abp morelos senior high"],
            ["title" => "college"],
        ]);
    }
}
