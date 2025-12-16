<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index() {
        return Faq::all();
    }

    public function store(Request $request) {
        return Faq::create($request->all());
    }

    public function update(Request $request, $id) {
        $faq = Faq::findOrFail($id);
        $faq->update($request->all());
        return $faq;
    }

    public function destroy($id) {
        Faq::destroy($id);
        return response()->json(['success' => true]);
    }
    
}

