<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoryPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\CategoryPost::factory()->count(20)->create();
    }
}
