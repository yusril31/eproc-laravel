<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function store(Request $request) {
        $request->validate(['name' => 'required']);
        $vendor = Vendor::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return response()->json($vendor);
    }
}
