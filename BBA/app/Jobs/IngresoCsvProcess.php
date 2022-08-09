<?php

namespace App\Jobs;

use App\Models\Ingreso;
use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class IngresoCsvProcess implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /*public $header;
    public $data;

    public function __construct($data, $header)
    {
        $this->data = $data;
        $this->header = $header;
        dd($data,$header);
    }*/

    public function handle()
    {
        $header = [];
        $path = resource_path('temp');
        $files = glob("$path/*.csv");
        foreach ($files as $key => $file)
        {
            //$data = array_map('str_getcsv', file($file), [";"]);
            $data = array_map(function($file){return str_getcsv($file, ";");}, file($file));
            if($key ===0){
                $header = $data[0];
                unset($data[0]);
            }
        }

        foreach($data as $ingreso){
            $ingresoData = array_combine($header, $ingreso);
            Ingreso::create($ingresoData);
        }
        unlink($file);
    }
}
