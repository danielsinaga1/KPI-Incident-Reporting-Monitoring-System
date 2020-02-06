<?php

namespace App\Http\Controllers\Admin;
use App\ClassificationDetail;
use DB;

class HomeController
{
    public function index()
    {
        
        $countOpenCorrective = DB::table('incident_reports')->select('perbaikan')
        ->where('status','Open')
        ->where('perbaikan', '!=','NULL')->count();
        $countCloseCorrective = DB::table('incident_reports')->select('perbaikan')
        ->where('status','Close')
        ->where('perbaikan', '!=','NULL')->count();
        $countOpenPreventive = DB::table('incident_reports')->select('pencegahan')
        ->where('status','Open')
        ->where('perbaikan', '!=','NULL')->count();
        $countClosePreventive = DB::table('incident_reports')->select('pencegahan')
        ->where('status','Close')
        ->where('perbaikan', '!=','NULL')->count();

        $countPreventive = DB::table('incident_reports')->select('pencegahan')
        ->where('pencegahan','!=','NULL')->count();

        $countCorrective = DB::table('incident_reports')->select('perbaikan')
        ->where('perbaikan','!=','NULL')->count();

        $countCloseCorrectivePreventive = $countCloseCorrective + $countClosePreventive;

        $countOpenCorrectivePreventive = $countOpenCorrective + $countOpenPreventive;

        $countCorrectivePreventive = $countPreventive + $countCorrective;

        $data2 = DB::table('incident_reports')
        ->join('category_incidents','incident_reports.cat_id','category_incidents.id')
        ->select(DB::raw('name, count(*) as y'))
        ->groupBy('name')
        ->get();

        $matrixs = ClassificationDetail::orderBy('classify_id')->orderBy('cat_id')->get();
        $rows = [];
        $columns = [];

        foreach ($matrixs as $index => $matrix) {
            // Create an empty a    rray if the key does not exist yet
            if(!isset($rows[$matrix->classify_id])) {
                $rows[$matrix->classify_id] = [];
            }
            
              // Add the column to the array of columns if it's not yet in there
            if(!in_array($matrix->cat_id, $columns)) {
                $columns[] = $matrix->cat_id;
            }
             // Add the grade to the 2 dimensional array
             $rows[$matrix->classify_id][$matrix->cat_id] = $matrix->description;
        }

        return view('home',compact('matrixs','rows','columns','data2','countOpenCorrective','countCloseCorrective','countOpenPreventive','countClosePreventive','countPreventive','countCorrective','countCorrectivePreventive','countCloseCorrectivePreventive','countOpenCorrectivePreventive'));
    }
}
