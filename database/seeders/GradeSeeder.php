<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Str;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 10; $i <= 12; $i++) {
            for ($j = 1; $j <= 3; $j++) {
                $postfix = ($j == 1) ? 'a' : (($j == 2) ? 'b' : 'c');
                $grade = new Grade();
                $grade->name = Str::upper($i . '-' . $postfix);
                $grade->save();

                for ($x = 1; $x <= 10; $x++) {
                    $student = new Student();
                    $student->nisn = mt_rand(1000000000, 9999999999);
                    $student->name = "Murid" . $x . "-" . $grade->id;
                    $student->gender = ($x % 2) ? 'male' : 'female';
                    $student->phone = "0899630880" . $x;
                    $student->address = "Jalan Sunan Kalijaga No." . $x . " Blok " . $postfix;
                }
            }
        }
    }
}
