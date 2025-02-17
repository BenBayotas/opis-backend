<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subject_categories')->insert([
            ["title" => "Academic"],
            ["title" => "Non-Academic"],
            ["title" => "Computer"],
            ["title" => "NSTP"],
        ]);
    }
}
