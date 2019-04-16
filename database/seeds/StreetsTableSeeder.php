<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use App\Kladr;
use App\Street;

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

        $arKladr = Kladr::all()->pluck('code', 'id')->all();
        $streets = Street::all();

        foreach ($streets as $street)
        {
            $code = $street->code;
            $kladr_id = array_search(substr($street->code, 0, -6) . '00', $arKladr);

            $street->region = substr($code, 0, 2);
            $street->district = substr($code, 2, 3);
            $street->city = substr($code, 5, 3);
            $street->town = substr($code, 8, 3);
            $street->street = substr($code, 11, 4);
            $street->relevance = substr($code, 15, 2);

            if ($kladr_id)
            {
                $street->kladr_id = $kladr_id;
            }

            $street->save();
        }
    }
}
