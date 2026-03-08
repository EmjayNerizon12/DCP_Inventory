<?php

namespace App\Http\Controllers;

use App\Models\DCPBatchItemBrand;
use App\Models\DCPCurrentCondition;
use App\Models\DCPDeliveryCondintion;
use App\Models\DCPItemAssignedType;
use App\Models\DCPItemBrand;
use App\Models\DCPItemLocation;
use App\Models\DCPItemModeDelivery;
use App\Models\DCPItemTypes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class DCPItemTypesController extends Controller
{
    public function index()
    {
        $itemTypes = DCPItemTypes::orderBy('name', 'asc')->get();

        return view('AdminSide.DCPBatch.ItemTypes', compact('itemTypes'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'code' => ['required', 'string', 'max:255', Rule::unique('dcp_item_types', 'code')],
                'name' => ['required', 'string', 'max:255'],
            ]);

            $itemType = DCPItemTypes::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Created successfully.',
                'data' => $itemType,
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
                'message' => 'Something went wrong while creating the item type.',
            ], 500);
        }
    }

    public function destroy($id)
    {
        // Logic to delete the item type by ID
        $itemType = DCPItemTypes::findOrFail($id);
        $itemType->delete();

        return redirect()->route('index.dcp.items')->with('success', 'Item Type deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'code' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('dcp_item_types', 'code')->ignore($id, 'pk_dcp_item_types_id'),
                ],
                'name' => ['required', 'string', 'max:255'],
            ]);

            $itemType = DCPItemTypes::findOrFail($id);
            $itemType->fill($validated);
            $itemType->save();

            return response()->json([
                'success' => true,
                'message' => 'Updated successfully.',
                'data' => $itemType,
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
                'message' => 'Something went wrong while updating the item type.',
            ], 500);
        }
    }

    public function search_item_type(Request $request)
    {
        $keyword = $request->query('query');

        $results = DCPItemTypes::where('code', 'like', "%{$keyword}%")
            ->orWhere('name', 'like', "%{$keyword}%")
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($results);
    }

    public function storeDeliveryMode(Request $request)
    {
        $request->validate([
            'delivery_mode' => 'required|string|max:255',
        ]);

        DCPItemModeDelivery::create(['name' => $request->delivery_mode]);

        return redirect()->route('index.crud')->with('success', 'Delivery Mode added successfully.');
    }

    public function storeDeliveryCondition(Request $request)
    {
        $request->validate([
            'delivery_condition' => 'required|string|max:255',
        ]);

        DCPDeliveryCondintion::create(['name' => $request->delivery_condition]);

        return redirect()->route('index.crud')->with('success', 'Item Condition Upon Delivery added successfully.');
    }

    public function storeCurrentCondition(Request $request)
    {
        $request->validate([
            'current_condition' => 'required|string|max:255',
        ]);

        DCPCurrentCondition::create(['name' => $request->current_condition]);

        return redirect()->route('index.crud')->with('success', 'Item Current Condition added successfully.');
    }

    public function storeAssignedUserType(Request $request)
    {
        $request->validate([
            'assigned_user_type' => 'required|string|max:255',
        ]);

        DCPItemAssignedType::create(['name' => $request->assigned_user_type]);

        return redirect()->route('index.crud')->with('success', 'The assigned user type has been added successfully.');
    }

    public function storeAssignedLocation(Request $request)
    {
        $request->validate([
            'assigned_location' => 'required|string|max:255',
        ]);

        DCPItemLocation::create(['name' => $request->assigned_location]);

        return redirect()->route('index.crud')->with('success', 'The assigned location for the DCP Items has been added successfully.');
    }

    public function storeSupplier(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);

        DCPItemBrand::create(['name' => $request->brand_name]);

        return redirect()->route('index.crud')->with('success', 'Brand Supplier added successfully.');
    }

    public function storeBrand(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);

        DCPBatchItemBrand::create(['brand_name' => $request->brand_name]);

        return redirect()->route('index.crud')->with('success', 'Brand Supplier added successfully.');
    }

    public function editDeliveryMode(Request $request, $id)
    {
        $request->validate([
            'delivery_mode' => 'required|string|max:255',
        ]);

        $deliveryMode = DCPItemModeDelivery::findOrFail($id);
        $deliveryMode->name = $request->delivery_mode;
        $deliveryMode->save();

        return redirect()->back()->with('success', 'Delivery Mode updated successfully!');
    }

    public function editDeliveryCondition(Request $request, $id)
    {
        $request->validate([
            'delivery_condition' => 'required|string|max:255',
        ]);

        $deliveryCondition_update = DCPDeliveryCondintion::findOrFail($id);
        $deliveryCondition_update->name = $request->delivery_condition;
        $deliveryCondition_update->save();

        return redirect()->back()->with('success', 'Item Condition Upon Delivery updated successfully!');
    }

    public function editCurrentCondition(Request $request, $id)
    {
        $request->validate([
            'current_condition' => 'required|string|max:255',
        ]);

        $currentCondition_update = DCPCurrentCondition::findOrFail($id);
        $currentCondition_update->name = $request->current_condition;
        $currentCondition_update->save();

        return redirect()->back()->with('success', 'Item Current Condition updated successfully!');
    }

    public function editSupplier(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);
        $brandSupplier = DCPItemBrand::findOrFail($id);
        $brandSupplier->name = $request->brand_name;
        $brandSupplier->save();

        return redirect()->route('index.crud')->with('success', 'Brand Supplier updated successfully!');
    }

    public function editBrand(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);
        $brandSupplier = DCPBatchItemBrand::findOrFail($id);
        $brandSupplier->brand_name = $request->brand_name;
        $brandSupplier->save();

        return redirect()->route('index.crud')->with('success', 'Brand Supplier updated successfully!');
    }

    public function editAssignedUserType(Request $request, $id)
    {
        $request->validate([
            'assigned_user_type' => 'required|string|max:255',
        ]);
        $assigned_user_type_update = DCPItemAssignedType::findOrFail($id);
        $assigned_user_type_update->name = $request->assigned_user_type;
        $assigned_user_type_update->save();

        return redirect()->route('index.crud')->with('success', 'The assigned user type has been updated successfully!');
    }

    public function editAssignedLocation(Request $request, $id)
    {
        $request->validate([
            'assigned_location' => 'required|string|max:255',
        ]);
        $assigned_location_update = DCPItemLocation::findOrFail($id);
        $assigned_location_update->name = $request->assigned_location;
        $assigned_location_update->save();

        return redirect()->route('index.crud')->with('success', 'The assigned location for the DCP Item has been updated successfully!');
    }

    public function deleteDeliveryMode($id)
    {
        $deliveryMode = DCPItemModeDelivery::findOrFail($id);
        $deliveryMode->delete();

        return redirect()->route('index.crud')->with('success', 'Delivery Mode deleted successfully!');
    }

    public function deleteDeliveryCondition($id)
    {
        $deliveryMode = DCPDeliveryCondintion::findOrFail($id);
        $deliveryMode->delete();

        return redirect()->route('index.crud')->with('success', 'Item Condition Upon Delivery deleted successfully!');
    }

    public function deleteCurrentCondition($id)
    {
        $deliveryMode = DCPCurrentCondition::findOrFail($id);
        $deliveryMode->delete();

        return redirect()->route('index.crud')->with('success', 'Item Current Condition deleted successfully!');
    }

    public function deleteSupplier($id)
    {
        $brandSupplier = DCPItemBrand::findOrFail($id);
        $brandSupplier->delete();

        return redirect()->route('index.crud')->with('success', '  Supplier deleted successfully!');
    }

    public function deleteBrand($id)
    {
        $brandSupplier = DCPBatchItemBrand::findOrFail($id);
        $brandSupplier->delete();

        return redirect()->route('index.crud')->with('success', 'Brand   deleted successfully!');
    }

    public function deleteAssignedUserType($id)
    {
        $assigned_delete = DCPItemAssignedType::findOrFail($id);
        $assigned_delete->delete();

        return redirect()->route('index.crud')->with('success', 'The assigned user type deleted successfully!');
    }

    public function deleteAssignedLocation($id)
    {
        $assigned_location_delete = DCPItemLocation::findOrFail($id);
        $assigned_location_delete->delete();

        return redirect()->route('index.crud')->with('success', 'The assigned location for the DCP Item deleted successfully!');
    }
}
