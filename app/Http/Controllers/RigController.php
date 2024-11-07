<?php

namespace App\Http\Controllers;

use App\Models\Rig;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RigController extends Controller
{

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function createRig(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'company_id' => 'required|exists:companies,id',
        ]);

        Rig::create([
            'name' => $request->name,
            'location' => $request->location,
            'company_id' => $request->company_id,
            'registered_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Rig added to the company successfully!');
    }
}
