<?php

use Illuminate\Database\Seeder;
use App\ExamType;
class ExamTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = new ExamType();
        $type->name = "Final";                
        $type->save();

        $type1 = new ExamType();
        $type1->name = "MidTerm";        
        $type1->save();
    }
}
