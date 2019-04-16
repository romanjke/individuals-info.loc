<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Repositories\Repository;

class ReportsController extends Controller
{
    public function showEvenHousesResidents(Request $request, Repository $repository)
    {
        $page = $request->has('page') ? $request->query('page') : 1;

        $houses = Cache::remember('housesResidents_page_' . $page, 15, function() use ($repository) {
            return $repository->getEvenHousesResidents()->paginate('15');
        });

        // $houses = $repository->getEvenHousesResidents()->paginate('15');

        return view('reports.report-1', compact('houses'));
    }

    public function showIndividualsData(Request $request, Repository $repository)
    {
        $page = $request->has('page') ? $request->query('page') : 1;

        $data = Cache::remember('individualsData_page_' . $page, 15, function() use ($repository) {
            return $repository->getIndividualsData()->paginate('15');
        });

        // $data = $repository->getIndividualsData()->paginate('15');

        return view('reports.report-2', compact('data'));
    }

    public function showEmptyHouses(Request $request, Repository $repository)
    {
        $page = $request->has('page') ? $request->query('page') : 1;

        $houses = Cache::remember('emptyHouses_page_' . $page, 15, function() use ($repository) {
            return $repository->getEmptyHouses()->paginate('15');
        });

        // $houses = $repository->getEmptyHouses()->paginate('15');

        return view('reports.report-3', compact('houses'));
    }

    public function showHousesCodes(Request $request, Repository $repository)
    {
        $page = $request->has('page') ? $request->query('page') : 1;

        $housesCodes = Cache::remember('housesCodes_page_' . $page, 15, function() use ($repository) {
            return $repository->getHousesCodes()->paginate('15');
        });

        // $housesCodes = $repository->getHousesCodes()->paginate('15');

        return view('reports.report-4', compact('housesCodes'));
    }
}
