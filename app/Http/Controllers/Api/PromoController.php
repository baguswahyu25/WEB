<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use App\Services\FirebaseNotificationService;
use App\Models\FcmToken;

class PromoController extends Controller
{
   public function index()
{
    return Promo::where('is_active', true)
        ->latest()
        ->get(); // 🔥 JANGAN MAP LAGI
}

public function show($id)
{
    return Promo::where('id', $id)
        ->where('is_active', true)
        ->firstOrFail();
}

}

