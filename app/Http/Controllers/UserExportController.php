<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserExportController extends Controller
{
    /**
     * Exporta la lista de usuarios a un archivo de Excel.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'usuarios.xlsx');
    }
}