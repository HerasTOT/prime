<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'company' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'supervisor' => 'nullable|string|max:255',
            'company_phone' => 'nullable|string|max:20',
            'salary' => 'nullable|numeric',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date', 
            'termination_reason' => 'nullable|string|max:255',
        ]);
        Experience::create([
            
                'email' => $validated['email'],
                'company' => $validated['company'],
                'position' => $validated['position'],
                'address' => $validated['address'],
                'supervisor' => $validated['supervisor'],
                'company_phone' => $validated['company_phone'],
                'salary' => $validated['salary'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'termination_reason' => $validated['termination_reason'],
            
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Experience $experience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience)
    {
        //
    }
}
