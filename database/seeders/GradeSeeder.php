<?php

namespace Database\Seeders;

use App\Models\Grade;
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
            }
        }
    }
}
