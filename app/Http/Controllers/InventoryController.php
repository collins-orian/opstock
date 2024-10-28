<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Validation\ValidationException;

class InventoryController extends Controller
{
    /**
     * Display the dashboard with the list of items.
     */
    public function index()
    {
        // Fetch all items from the database to display on the dashboard
        $items = Item::all();
        // Pass the items to the view
        return view('dashboard', ['items' => $items]);
    }

    /**
     * Add a new item to the inventory.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function addItem(Request $request): RedirectResponse
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
        ]);

        // Create the item using the model's method
        Item::createItem($validatedData['name'], $validatedData['quantity']);

        // Redirect back with a success message
        return redirect()->route('dashboard')->with('success', 'Item added successfully!');
    }

    /**
     * Stock in items to the inventory.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function stockIn(Request $request): RedirectResponse
    {
        // Validate the request data
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Find the item by its ID
        $item = Item::find($validated['item_id']);

        // Update the item's quantity by adding the new stock
        $item->quantity += $validated['quantity'];
        $item->save();

        // Redirect back to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Stock updated successfully.');
    }


    /**
     * Stock out items from the inventory.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function stockOut(Request $request): RedirectResponse
    {
        $item = Item::find($request->item_id);
        $quantityToStockOut = $request->quantity;

        if ($item && $quantityToStockOut > 0 && $item->quantity >= $quantityToStockOut) {
            $item->quantity -= $quantityToStockOut;
            $item->save();

            return redirect()->back()->with('success', 'Stock out operation completed successfully.');
        }

        return redirect()->back()->with('error', 'Invalid stock out quantity or item not found.');
    }


    /**
     * Delete items from the inventory.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        $item = Item::find($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }


//    public function edit($id)
//    {
//        $item = Item::findOrFail($id);
//        return view('items.edit', compact('item'));
//    }

}
