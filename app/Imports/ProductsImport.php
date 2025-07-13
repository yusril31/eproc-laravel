<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Auth;

class ProductsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $vendorId = Auth::user()->vendor->id;

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // skip header
            Product::create([
                'name' => $row[0],
                'description' => $row[1] ?? null,
                'price' => $row[2],
                'vendor_id' => $vendorId,
            ]);
        }
    }
}
