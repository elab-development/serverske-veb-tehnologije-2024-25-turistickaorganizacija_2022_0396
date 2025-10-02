<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Destination;

class DestinationApiController extends Controller
{
    public function index()
    {
        return response()->json(Destination::all());
    }
}
