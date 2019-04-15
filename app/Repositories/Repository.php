<?php

namespace App\Repositories;

use App\User;
use Illuminate\Database\DatabaseManager;

class Repository
{
    private $_db;

    public function __construct(DatabaseManager $db)
    {
        $this->_db = $db;
    }

    public function evenHousesResidents()
    {
        $query = $this->_db->connection()->table('individuals as i')
                                        ->join('houses as h', 'h.id', '=', 'i.house_id');
                    // ->join('street', 'street.id', '=', 'houses.street_id')
                    // ->join('kladr', 'kladr.id', '=', 'street.kladr_id');

        $houses = $query->select('i.house as house', $this->_db->raw('count(*) as cnt'))
                        // ->where('house', $this->_db->raw('cast("house" as unsigned) % 2 = 0'))
                        ->groupBy('house', 'house_id')
                        ->orderBy('house', 'asc')
                        ->get();

        // $arHouses = array();

        // foreach ($houses as $key => $house)
        // {
        //     if ((int)$house->house % 2 == 0)
        //     {
        //         $arHouses[] = $house;
        //     }
        // }

        // $houses = collect($arHouses);

        foreach ($houses as $key => $house)
        {
            if ((int)$house->house % 2 !== 0)
            {
                $houses->forget($key);
            }
        }

        return $houses;
    }

    public function emptyHouses()
    {
        $conn = $this->_db->connection();

        $houses = $conn->table('houses as h')
                        ->join('streets as s', 's.id', '=', 'h.street_id')
                        ->join('kladr as k', 'k.id', '=', 's.kladr_id')
                        ->select('k.name as city','k.socr as city_socr', 's.name as street',
                                's.socr as street_socr', 'h.name as houses_numbers', 'h.id')
                        ->get();

        $livingHouses = $conn->table('individuals as i')
                            ->select('house_id', 'house')
                            ->get();

        foreach ($houses as $house)
        {
            foreach ($livingHouses as $livingHouse)
            {
                if ($house->id == $livingHouse->house_id)
                {
                    $arHouses = array_map('trim', explode(',', $house->houses_numbers));
                    $key = array_search($livingHouse->house, $arHouses);
                    array_splice($arHouses, $key, 1);
                    $house->houses_numbers = implode(',', $arHouses);
                }
            }
        }

        return $houses;
    }
}