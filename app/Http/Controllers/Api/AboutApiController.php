<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AboutApiController extends Controller
{
    public function __invoke(): JsonResponse
    {
        // Minimalan “About” JSON; kasnije možemo povući iz baze
        return response()->json([
            'title'   => 'O nama',
            'content' => 'TripSummit – putovanja, aranžmani i avanture širom sveta.',
        ]);
    }
}
