<?php

use Flynsarmy\CsvSeeder\CsvSeeder;
use App\Kladr;

class KladrTableSeeder extends CsvSeeder {

    public function __construct()
    {
        $this->table = 'kladr';
        $this->csv_delimiter = ';';
        $this->filename = base_path().'/database/seeds/csvs/kladr.csv';
    }

    public function run()
    {
        // Recommended when importing larger CSVs
        DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
        // DB::table($this->table)->truncate();

        parent::run();

        $kladr = Kladr::all();

        foreach ($kladr as $item)
        {
            $code = $item->code;
            $item->region = substr($code, 0, 2);
            $item->district = substr($code, 2, 3);
            $item->city =substr($code, 5, 3);
            $item->town =substr($code, 8, 3);
            $item->relevance = substr($code, 11, 2);
            $item->save();
        }
    }
}
