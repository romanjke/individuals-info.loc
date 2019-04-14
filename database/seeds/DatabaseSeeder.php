<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(KladrTableSeeder::class);
        $this->call(StreetsTableSeeder::class);
        $this->call(HousesTableSeeder::class);
        $this->call(IndividualsTableSeeder::class);
    }
}
