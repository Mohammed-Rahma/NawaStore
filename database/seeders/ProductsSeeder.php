<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i <=10; $i++) { 
            DB::table('products')->insert([
                'name'=>'products'.$i,
                'slug'=> 'user_'. $i,
                'image'=>'s.png',
                'created_at'=>now()
            ]);
    }
}
}