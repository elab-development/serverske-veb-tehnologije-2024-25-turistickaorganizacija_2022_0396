<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;

class FaqApiController extends Controller
{
    public function index()
    {
        $faqs = Faq::select('id', 'question', 'answer')
            ->orderBy('id', 'asc')
            ->get();

        return response()->json([
            'count' => $faqs->count(),
            'data'  => $faqs
        ]);
    }
}
