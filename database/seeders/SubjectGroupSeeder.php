<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subject_groups')->insert([
            ["title" => "*ECC 112"],
            ["title" => "*ECC 122"],
            ["title" => "*ECC 312"],
            ["title" => "*ECC 314"],
            ["title" => "*ECC 321"],
        ]);
    }
}
