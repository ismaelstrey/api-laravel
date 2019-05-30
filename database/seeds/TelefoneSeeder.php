<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class TelefoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *'cliente_id' => rand(1,30)
     * @return void
     */
    public function run()
    {
        // $faker = Faker\Provider\pt_BR\PhoneNumber::create();
        $faker = Faker::create();
        foreach(range(1,30) as $i){
            App\Models\Telefone::create([
                'numero' => $faker->tollFreePhoneNumber,
                'cliente_id' => rand(1,30)
            ]);
        }
    }
}
