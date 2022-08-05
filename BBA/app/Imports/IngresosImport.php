<?php

namespace App\Imports;

use App\Models\Ingreso;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IngresosImport implements ToModel, WithHeadingRow
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
}
