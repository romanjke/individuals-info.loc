<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Repository;

class ReportsController extends Controller
{
    public function getEvenHousesResidents(Repository $repository)
    {
        $houses = $repository->evenHousesResidents()->paginate('15');

        return view('reports.report-1', compact('houses'));
    }

    public function getEmptyHouses(Repository $repository)
    {
        $houses = $repository->emptyHouses()->paginate('15');

        return view('reports.report-3', compact('houses'));
    }
}
