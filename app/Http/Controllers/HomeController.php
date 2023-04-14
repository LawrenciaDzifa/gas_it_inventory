<?php

namespace App\Http\Controllers;

use App\Models\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\RequisitionDataTable;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    //     public function index()
    //     {
    //         // pass requisition datatable to home view
    //         // $requisitions = Requisition::all();
    //         // $requisitions = Requisition::orderBy('id', 'desc')->take(5)->get();
    //         $totalItems = DB::table('items')->count();
    //         $totalRequisitions = DB::table('requisitions')->count();
    //         $totalAssignments = DB::table('assignments')->count();
    //         // $dataTable = DB::table('requisitions')->select('*');

    //         return view('home', [
    //             'totalItems' => $totalItems,
    //             'totalRequisitions' => $totalRequisitions,
    //             'totalAssignments' => $totalAssignments,
    //         ]);
    //     }
    // }

    public function index(RequisitionDataTable $dataTable)
    {
        // $userId = auth()->user(); // Get the ID of the logged-in user
        $totalItems = DB::table('items')->count();
        $totalRequisitions = DB::table('requisitions')->count();
        $totalAssignments = DB::table('assignments')->count();

        // Fetch all requisitions from the database if the current route is not 'home'
        if (request()->route()->getName() != 'home') {
            $requisitions = Requisition::all();
        } else {
            // Fetch only the first five requisitions from the database if the current route is 'home'
            $requisitions = Requisition::take(5)->get();
        }

        return $dataTable->render(request()->route()->getName(), [
            'totalItems' => $totalItems,
            'totalRequisitions' => $totalRequisitions,
            'totalAssignments' => $totalAssignments,
            'requisitions' => $requisitions,
        ]);
    }
}
