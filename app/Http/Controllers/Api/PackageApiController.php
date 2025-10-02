<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Package;

class PackageApiController extends Controller
{
    public function index()
    {
        return response()->json(Package::with(['destination'])->get());
    }
}
