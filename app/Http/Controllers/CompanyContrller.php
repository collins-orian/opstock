<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyContrller extends Controller
{

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function createCompany(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
        ]);

        $company = Company::create([
            'name' => $request->name,
            'address' => $request->address,
            'registered_by' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Company created successfully!');
    }
}
