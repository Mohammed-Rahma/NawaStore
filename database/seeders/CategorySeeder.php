<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        //الكود المسؤل على اظافة البيانات داخل جدول الكاتيقوري 

        for ($i=0; $i <=10; $i++) { 
            DB::table('catrgories')->insert([
                'name'=>'category'.$i,
                'created_at'=>now()
            ]);
        }
    }
}
