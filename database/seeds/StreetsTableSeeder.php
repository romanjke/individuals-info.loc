<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class StreetsTableSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->table = 'streets';
        $this->csv_delimiter = ';';
        $this->filename = base_path().'/database/seeds/csvs/streets.csv';
    }

    public function run()
    {
        // Recommended when importing larger CSVs
        DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
        // DB::table($this->table)->truncate();

        parent::run();

        $arKladr = App\Kladr::all()->pluck('code', 'id')->all();
        $streets = App\Street::all();

        foreach ($streets as $street)
        {
            $kladr_id = array_search(substr($street->code, 0, -6) . '00', $arKladr);

            if($kladr_id)
            {
                $street->kladr_id = $kladr_id;
                $street->save();
            }
        }
    }
}
