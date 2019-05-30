<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class FilmeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,30) as $i){
            App\Models\Filme::create([
                'titulo' => $faker->name(),
                'capa' => $faker->imageUrl($width = 640, $height = 480)
            ]);
        }
    }
}
