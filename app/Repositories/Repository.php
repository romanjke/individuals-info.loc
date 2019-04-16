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
                    // ->join('street', 'street.id', '=', 'houses.street_id')
                    // ->join('kladr', 'kladr.id', '=', 'street.kladr_id');

        $houses = $query->select('i.house as house', $this->_db->raw('count(*) as cnt'))
                        // ->where('house', $this->_db->raw('cast("house" as unsigned) % 2 = 0'))
                        ->groupBy('house', 'house_id')
                        ->orderBy($this->_db->raw('CAST(house as UNSIGNED)'), 'asc')
                        ->get();

        // dd($houses);
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
                        ->get();

        $livingHouses = $conn->table('individuals as i')
                            ->select('house_id', 'house')
                            ->get();

        // $kladr = $conn->table('kladr')->select('name', 'socr', 'code')->get();

        // dd($houses);

        foreach ($houses as $house)
        {
            // $rCode = $house->region;
            // $dCode = $house->district;
            // $cCode = $house->city;
            // $tCode = $house->town;
            // $socr = $house->site_socr;
            // $district = '';
            // $city = '';
            // $town = '';

            // if ($dCode !== '000' && $cCode == '000' && $tCode == '000')
            // {
            //     $obDistrict = $kladr->firstWhere('code', $rCode . $dCode . '00000000');
            //     $district = isset($obDistrict) ? $obDistrict->name . ' ' . $obDistrict->socr . ', ' : '';
            // }

            // if ($cCode !== '000')
            // {
            //     $obCity = $kladr->firstWhere('code', $rCode . '000' . $cCode.'00000');
            //     $city = isset($obCity) ? $obCity->name . ' ' . $obCity->socr . ', ' : '';
            // }

            // if ($dCode == '000' && $cCode == '000' && $tCode !== '000')
            // {
            //     $obTown = $kladr->firstWhere('code', $rCode . '000000' . $tCode . '00');
            //     $town = isset($obTown) ? $obTown->name . ' ' . $obTown->socr . ', ' : '';
            // }

            // $site = $district . $city . $town;
            // $house->site = $site;

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