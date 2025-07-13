<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $vendor = Auth::user()->vendor;
        return Product::where('vendor_id', $vendor->id)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'vendor_id' => Auth::user()->vendor->id
        ]);

        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $product->update($request->only('name', 'description', 'price'));
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|file|mimes:csv,txt']);
        Excel::import(new ProductsImport, $request->file('file'));
        return response()->json(['message' => 'Import successful']);
    }

    public function trashed()
    {
        $product = Product::onlyTrashed()->get();
        return response()->json($product);
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->where('id', $id)->restore();
        return response()->json(['message' => 'Restored']);
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->where('id', $id)->forceDelete();
        return response()->json(['message' => 'Deleted permanently']);
    }
}
