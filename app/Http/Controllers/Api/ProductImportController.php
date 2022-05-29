<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\ProductImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductImportController extends Controller
{
    public function store(Request $request)
    {
        Excel::import(new ProductImport, $request->file('file'));

        return response()->json([
            'status' => true,
        ]);
    }
}
