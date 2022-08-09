<?php

namespace App\Imports;

use App\Models\Ingreso;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class IngresosImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ingreso([
            'tipomov' =>  $row['tipomov'],
            'codigo' => $row['codigo'],
            'prod' =>  $row['prod'],
            'nombre' => $row['nombre'],
            'direccion' => $row['direccion'],
            'certificado' => $row['certificado'],
            'departamento' => $row['departamento'],
            'civ' => $row['civ'],
            'celular' => $row['celular'],
            'fechanac' => $row['fechanac'],
            'fecha1' => $row['fecha1'],
            'fechafin' => $row['fechafin'],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
