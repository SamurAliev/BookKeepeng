<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'title' => 'Заработная плата',
            'type_id' => '1'
        ]);
        DB::table('categories')->insert([
            'title' => 'Сдача в аренду',
            'type_id' => '1'
        ]);
        DB::table('categories')->insert([
            'title' => 'Продукты питания',
            'type_id' => '2'
        ]);
        DB::table('categories')->insert([
            'title' => 'Транспорт',
            'type_id' => '2'
        ]);
        DB::table('categories')->insert([
            'title' => 'Мобильная связь',
            'type_id' => '2'
        ]);
        DB::table('categories')->insert([
            'title' => 'Интернет',
            'type_id' => '2'
        ]);
        DB::table('categories')->insert([
            'title' => 'Развлечения',
            'type_id' => '2'
        ]);
    }
}
