<?php

namespace App\Http\Controllers;

use App\Models\DCPItemTypes;
use App\Models\DCPPackageContent;
use App\Models\DCPPackageTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class DCPPackageTypeController extends Controller
{
    public function packagesJson(Request $request)
    {
        $rows = DB::table('dcp_package_types')
            ->leftJoin('dcp_package_content', 'dcp_package_types.pk_dcp_package_types_id', '=', 'dcp_package_content.dcp_package_types_id')
            ->leftJoin('dcp_item_types', 'dcp_package_content.dcp_item_types_id', '=', 'dcp_item_types.pk_dcp_item_types_id')
            ->leftJoin(
                'dcp_batch_item_brands',
                'dcp_package_content.dcp_batch_item_brands_id',
                '=',
                'dcp_batch_item_brands.pk_dcp_batch_item_brands_id'
            )
            ->select(
                'dcp_package_types.pk_dcp_package_types_id as package_id',
                'dcp_package_types.code as package_code',
                'dcp_package_types.name as package_name',
                'dcp_package_content.pk_dcp_package_content_id as id',
                'dcp_item_types.pk_dcp_item_types_id as item_type_id',
                'dcp_item_types.name as item_name',
                'dcp_package_content.quantity',
                'dcp_package_content.unit_price',
                'dcp_package_content.dcp_batch_item_brands_id as brand_id',
                'dcp_batch_item_brands.brand_name as brand_name',
            )
            ->orderByRaw("CAST(REGEXP_SUBSTR(dcp_package_types.name, '[0-9]{4}') AS UNSIGNED) DESC")
            ->orderBy('dcp_package_types.pk_dcp_package_types_id', 'desc')
            ->orderBy('dcp_package_content.pk_dcp_package_content_id', 'asc')
            ->get();

        $packagesById = [];

        foreach ($rows as $row) {
            $packageId = (int) $row->package_id;

            if (!isset($packagesById[$packageId])) {
                $packagesById[$packageId] = [
                    'id' => $packageId,
                    'code' => $row->package_code,
                    'name' => $row->package_name,
                    'items' => [],
                ];
            }

            if ($row->id !== null) {
                $packagesById[$packageId]['items'][] = [
                    'id' => (int) $row->id,
                    'item_type_id' => $row->item_type_id !== null ? (int) $row->item_type_id : null,
                    'item_name' => $row->item_name,
                    'quantity' => $row->quantity !== null ? (int) $row->quantity : 0,
                    'unit_price' => $row->unit_price !== null ? (float) $row->unit_price : 0.0,
                    'brand_id' => $row->brand_id !== null ? (int) $row->brand_id : null,
                    'brand_name' => $row->brand_name,
                ];
            }
        }

        $packages = array_values($packagesById);
        $usedItemsPerPackage = [];

        foreach ($packages as $package) {
            $usedItemsPerPackage[$package['id']] = array_values(array_filter(array_map(
                fn ($item) => $item['item_type_id'] !== null ? (int) $item['item_type_id'] : null,
                $package['items']
            ), fn ($v) => $v !== null));
        }

        return response()->json([
            'success' => true,
            'data' => [
                'packages' => $packages,
                'usedItemsPerPackage' => $usedItemsPerPackage,
            ],
        ]);
    }

    public function insertPackageItem(Request $request)
    {
        try {
            $validated = $request->validate([
                'insert_package_id' => ['required', Rule::exists('dcp_package_types', 'pk_dcp_package_types_id')],
                'insert_package_content_id' => ['required', Rule::exists('dcp_item_types', 'pk_dcp_item_types_id')],
                'insert_quantity' => ['required', 'integer', 'min:1'],
                'insert_unit_price' => ['required', 'numeric', 'min:0'],
                'insert_item_brand_id' => ['required', Rule::exists('dcp_batch_item_brands', 'pk_dcp_batch_item_brands_id')],
            ]);

            $exists = DCPPackageContent::where('dcp_package_types_id', $validated['insert_package_id'])
                ->where('dcp_item_types_id', $validated['insert_package_content_id'])
                ->exists();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item already exists in the package.',
                ], 409);
            }

            $packageContent = DCPPackageContent::create([
                'dcp_package_types_id' => $validated['insert_package_id'],
                'dcp_item_types_id' => $validated['insert_package_content_id'],
                'quantity' => $validated['insert_quantity'],
                'unit_price' => $validated['insert_unit_price'],
                'dcp_batch_item_brands_id' => $validated['insert_item_brand_id'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Item inserted successfully.',
                'data' => $packageContent,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while inserting the item.',
            ], 500);
        }
    }

    public function getItems($id)
    {
        $items = DCPPackageContent::where('dcp_package_types_id', $id)
            ->join('dcp_item_types', 'dcp_item_types.pk_dcp_item_types_id', '=', 'dcp_package_content.dcp_item_types_id')
            ->select('dcp_item_types.name as item_name', 'dcp_package_content.quantity')
            ->get();

        return response()->json($items);
    }

    public function index()
    {
        $itemTypes = DCPItemTypes::all();

        return view('AdminSide.DCPBatch.PackageType', compact('itemTypes'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'code' => ['required', 'string', 'max:255', Rule::unique('dcp_package_types', 'code')],
                'name' => ['required', 'string', 'max:255'],
                'item_type_id' => ['required', 'array', 'min:1'],
                'item_type_id.*' => ['required', Rule::exists('dcp_item_types', 'pk_dcp_item_types_id')],
                'item_brand_id' => ['required', 'array', 'min:1'],
                'item_brand_id.*' => ['required', Rule::exists('dcp_batch_item_brands', 'pk_dcp_batch_item_brands_id')],
                'quantity' => ['required', 'array', 'min:1'],
                'quantity.*' => ['required', 'integer', 'min:1'],
                'unit_price' => ['required', 'array', 'min:1'],
                'unit_price.*' => ['required', 'numeric', 'min:0'],
            ]);

            $packageType = DB::transaction(function () use ($validated) {
                $packageType = DCPPackageTypes::create([
                    'code' => $validated['code'],
                    'name' => $validated['name'],
                ]);

                foreach ($validated['item_type_id'] as $key => $itemTypeId) {
                    DCPPackageContent::create([
                        'dcp_package_types_id' => $packageType->pk_dcp_package_types_id,
                        'dcp_item_types_id' => $itemTypeId,
                        'quantity' => $validated['quantity'][$key] ?? null,
                        'unit_price' => $validated['unit_price'][$key] ?? null,
                        'dcp_batch_item_brands_id' => $validated['item_brand_id'][$key] ?? null,
                    ]);
                }

                return $packageType;
            });

            return response()->json([
                'success' => true,
                'message' => 'Package Type created successfully.',
                'data' => $packageType,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating the package type.',
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => ['required', Rule::exists('dcp_package_content', 'pk_dcp_package_content_id')],
                'package_id' => ['required', Rule::exists('dcp_package_types', 'pk_dcp_package_types_id')],
                'package_content_name' => ['required', Rule::exists('dcp_item_types', 'pk_dcp_item_types_id')],
                'quantity' => ['required', 'integer', 'min:1'],
                'edit_item_brand_id' => ['required', Rule::exists('dcp_batch_item_brands', 'pk_dcp_batch_item_brands_id')],
                'unit_price' => ['required', 'numeric', 'min:0'],
            ]);

            $package = DCPPackageContent::findOrFail($validated['id']);

            $package->update([
                'dcp_item_types_id' => $validated['package_content_name'],
                'quantity' => $validated['quantity'],
                'unit_price' => $validated['unit_price'],
                'dcp_batch_item_brands_id' => $validated['edit_item_brand_id'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Package updated successfully.',
                'data' => $package,
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Throwable $e) {
            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while updating the package.',
            ], 500);
        }
    }

    public function destroy(Request $request, $id)
    {

        $packageType = DCPPackageTypes::findOrFail($id);
        $packageType->delete();

        // DCPPackageContent::where('dcp_package_types_id', $id)->delete();
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Package deleted successfully.',
            ]);
        }

        return redirect()->back()->with('success', 'Package deleted successfully.');
    }

    public function deletePackageItem(Request $request, $id)
    {
        $packageItem = DCPPackageContent::findOrFail($id);
        // dd($packageItem);
        $packageTypeCount = DCPPackageContent::where('dcp_package_types_id', $packageItem->dcp_package_types_id)->count();

        if ($packageTypeCount == 1) {

            $packageItem->delete();
            // Optionally, you can also delete the associated package type if needed
            $packageType = DCPPackageTypes::where('pk_dcp_package_types_id', $packageItem->dcp_package_types_id)->first();
            $packageType->delete();
        } else {
            $packageItem->delete();
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Package item deleted successfully.',
            ]);
        }

        return redirect()->back()->with('success', 'Package item deleted successfully.');
    }
}
