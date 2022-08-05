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

    public $header;
    public $data;

    public function __construct($data, $header)
    {
        $this->data = $data;
        $this->header = $header;
        dd($data,$header);
    }

    public function handle()
    {
        foreach ($this->data as $ingreso) {
            $ingresoData = array_combine($this->header,$ingreso);

            //Ingreso::create($ingresoData);
        }
    }
}
