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

    public function getEvenHousesResidents()
    {
        $query = $this->_db->connection()->table('individuals as i')
                                        ->join('houses as h', 'h.id', '=', 'i.house_id');

        $houses = $query->select('i.house as house', $this->_db->raw('count(*) as cnt'))
                        ->groupBy('house', 'house_id')
                        ->orderBy($this->_db->raw('CAST(house as UNSIGNED)'), 'asc')
                        ->get();

        foreach ($houses as $key => $house)
        {
            if ((int)$house->house % 2 !== 0)
            {
                $houses->forget($key);
            }
        }

        return $houses;
    }

    public function getIndividualsData()
    {
        $data = $this->_db->connection()->table('individuals')
                                        ->select('fio', 'house', 'passport')
                                        ->get();

        return $data;
    }

    public function getEmptyHouses()
    {
        $conn = $this->_db->connection();

        $houses = $conn->table('houses as h')
                        ->join('streets as s', 's.id', '=', 'h.street_id')
                        ->join('kladr as k', 'k.id', '=', 's.kladr_id')
                        ->select('k.name as site', 'k.socr as site_socr', 's.name as street',
                                's.socr as street_socr', 'h.name as houses_numbers', 'h.id',
                                'k.code', 'k.region', 'k.district', 'k.city', 'k.town')
                        ->orderBy('site', 'asc')
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

                    $livingHouses->shift();
                }
            }
        }

        return $houses;
    }

    public function getHousesCodes()
    {
        $housesCodes = $this->_db->connection()
                                ->table('houses as h')
                                ->join('streets as s', 's.id', '=', 'h.street_id')
                                ->join('kladr as k', 'k.id', '=', 's.kladr_id')
                                ->select('k.name as site', 'k.socr as site_socr', 's.name as street',
                                        's.socr as street_socr', 'h.name as houses', 'h.index', 'h.gninmb', 'h.ocatd')
                                ->orderBy('site', 'asc')
                                ->get();

        return $housesCodes;
    }
}