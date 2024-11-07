<?php

namespace App\Http\Controllers;

use App\Models\Reagent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

class ReagentController extends Controller
{
    // Display a listing of the reagents
    public function index()
    {
        // Fetch all reagents from the database to display on the dashboard
        $reagents = Reagent::all();
        $creator = Reagent::with('creator')->get(); // Including the creator information
        // Pass the reagents to the view
        return view('reagents.index', ['reagents' => $reagents, 'creator' => $creator]);
    }

    /**
     * Show
     */
    public function create()
    {
        return view('reagents.create');
    }

    /**
     * Add a new reagent to the database
     * @throws ValidationException
     */
    public function addReagent(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'expiry_date' => 'required|date|after:today',
        ]);

        // Convert expiry_date string to Carbon instance
        $expiryDate = Carbon::parse($validatedData['expiry_date']);

        Reagent::createReagent($validatedData['name'], $validatedData['quantity'], $expiryDate);

        return redirect()->route('reagents.index')->with('success', 'Reagent added successfully.');
    }


//    // Find a specific reagent by ID
//    public function find($id): JsonResponse
//    {
//        $reagent = Reagent::with('registrar')->findOrFail($id); // Find reagent with registrar details
//        return response()->json($reagent);
//    }

    /**
     * Delete Reagents from the inventory.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        $reagent = Reagent::find($id);
        $reagent->delete();

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }

}
