<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaketKursusController extends Controller {
    public function index() {
        $paket = DB::table('paket_kursus')->get();
        return response()->json($paket);
    }
}
