<?php

namespace App\Http\Controllers;
use File;
use App\Models\Ingreso;
use Illuminate\Http\Request;
use App\Jobs\IngresoCsvProcess;
use App\Imports\IngresosImport;
use Illuminate\Support\Facades\Bus;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class IngresosController extends Controller
{
    public function index()
    {
        IngresosController::createTemp();
        return view('upload');
    }

    public function importJob(Request $request)
    {
        if ($request->has('csv')) {
            $csv = file($request->csv);
            $header = $csv[0];
            unset($csv[0]);
            $chunks = array_chunk($csv, 1000);

            foreach ($chunks as $key => $chunk) {
                $name = "\\tmp{$key}.csv";
                $path = resource_path('temp');
                //return $path . $name;
                file_put_contents($path . $name, $chunk);
            }
        }
        return view('welcome');
    }

    public function import(Request $request)
    {
        //Excel::import(new IngresosImport, $request->file);
        //Excel::queueImport(new IngresosImport, $request->file,null, \Maatwebsite\Excel\Excel::XLSX);
        //(new IngresosImport)->queue($excelFile, null, \Maatwebsite\Excel\Excel::XLSX);
        $excelFile = $request->file;
        Excel::queueImport(new IngresosImport, $request->file, null, \Maatwebsite\Excel\Excel::XLSX);

        return redirect('/')->with('success', 'All good!');
    }

    public function createTemp()
    {
        $path = resource_path('temp');;
        if (File::exists($path))
        {
            File::deleteDirectory($path);
            File::makeDirectory($path);
        }
        else
        {
            File::makeDirectory($path);
        }
    }

    public function store()
    {
        IngresoCsvProcess::dispatch();
        return 'stored';
    }
}
