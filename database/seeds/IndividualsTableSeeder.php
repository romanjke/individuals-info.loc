<?php

use Illuminate\Database\Seeder;

class IndividualsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Individual::class, 200)
            ->make()
            ->each(function ($individual) {
                $house = App\House::inRandomOrder()->first();

                $housesNumbers = array_map('trim', explode(',', $house->name));
                $randomNumber = $housesNumbers[array_rand($housesNumbers)];
                $individual->house = $randomNumber;

                $individual->house()->associate($house)->save();
            });
    }
}
