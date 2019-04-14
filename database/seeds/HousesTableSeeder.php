<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class HousesTableSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->table = 'houses';
        $this->csv_delimiter = ';';
        $this->filename = base_path().'/database/seeds/csvs/houses.csv';
    }

    public function run()
    {
        // Recommended when importing larger CSVs
        DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
        // DB::table($this->table)->truncate();

        parent::run();

        $arStreets = App\Street::all()->pluck('code', 'id')->all();
        $houses = App\House::all();

        foreach ($houses as $house)
        {
            $street_id = array_search($house->street_code, $arStreets);

            if($street_id)
            {
                $house->street_id = $street_id;
                $house->save();
            }
        }
    }
}
