<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        return response()->json(
            Promo::where('is_active', true)->latest()->get()
        );
    }

public function show($id)
{
    return response()->json(
        Promo::where('id', $id)
            ->where('is_active', true)
            ->firstOrFail()
    );
}

}
