<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aboutus = AboutUs::create([
            'title' => 'abouts us title',
            'description' => 'abouts us description',
        ]);
    }
}
