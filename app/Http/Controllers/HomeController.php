<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $matrixs = ClassificationDetail::orderBy('cat_id')->orderBy('classify_id')->get();
        // $rows = [];
        // $columns = [];

        // foreach ($matrixs as $index => $matrix) {
        //     // Create an empty array if the key does not exist yet
        //     if(!isset($rows[$matrix->classify_id])) {
        //         $rows[$matrix->classify_id] = [];
        //     }
            
        //       // Add the column to the array of columns if it's not yet in there
        //     if(!in_array($matrix->cat_id, $columns)) {
        //         $columns[] = $matrix->cat_id;
        //     }
        //      // Add the grade to the 2 dimensional array
        //      $rows[$matrix->classify_id][$matrix->cat_id] = $matrix->description;
        // }
        return view('home',compact('matrixs'));
    }
}
