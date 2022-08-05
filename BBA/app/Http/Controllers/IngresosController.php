<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use App\Jobs\IngresoCsvProcess;
use Illuminate\Http\Request;
use App\Imports\IngresosImport;
use Illuminate\Support\Facades\Bus;
use Maatwebsite\Excel\Facades\Excel;

class IngresosController extends Controller
{
    public function index()
    {
        return view('upload');
    }

    /*public function import(Request $request)
    {
        if( $request->has('csv') ) {
            $csv    = file($request->csv);
            $chunks = array_chunk($csv,1000);
            $header = [];
            $batch  = Bus::batch([])->dispatch();

            foreach ($chunks as $key => $chunk) {
            $data = array_map('str_getcsv', $chunk);
                if($key == 0){
                    $header = $data[0];
                    unset($data[0]);
                }
                $batch->add(new IngresoCsvProcess($data, $header));
            }
            return $batch;
        }
        return view ('welcome');
    }*/
    /*public function import(Request $request){
        $tmp_name = $_FILES["csv"]["tmp_name"];
        //dd($tmp_name);
        move_uploaded_file($tmp_name, "ingresos.csv");

        $csv = fopen("ingresos.csv", "r");
        dd($csv);
        while($row = fgetcsv($csv, 0, ";")) {
            $liste[]=[$row[0].";10.16.".$row[1].".".$row[2]];
       }
       fclose($csv);
    }*/

    public function import(Request $request){
        Excel::import(new IngresosImport, $request->file);

        return redirect('/')->with('success', 'All good!');
    }


}
