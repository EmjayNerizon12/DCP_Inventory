<?php

namespace App\Http\Controllers;

use App\Models\DCPBatchItem;
use Illuminate\Http\Request;

class AdminDCPProductController extends Controller
{
    public function index() {}

    public function searchPage()
    {
        return view('AdminSide.Product.search');
    }

    public function findItem(Request $request)
    {
        $validated = $request->validate([
            'searchInput' => 'nullable|string',
        ]);
        $searchInput = $validated['searchInput'];
        if (!$searchInput) {
            $items = DCPBatchItem::with(['dcpItemType'])->orderBy('generated_code', 'desc')
                ->paginate(10);
        } else {
            $items = DCPBatchItem::where('generated_code', 'like', '%' . $searchInput . '%')->with(['dcpItemType'])->orderBy('generated_code', 'desc')
                ->paginate(10);
        }

        return response()->json($items);
    }

    public function showItem(string $code)
    {

        $items = DCPBatchItem::where('generated_code', $code)->first();

        return view('AdminSide.Product.show', compact('items'));
    }
}
