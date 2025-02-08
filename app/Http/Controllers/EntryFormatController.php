<?php

namespace App\Http\Controllers;

use App\Models\EntryFormat;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;

class EntryFormatController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     private EntryFormat $model;
     private string $routeName;
     private string $source;
     private string $module = 'entryformat';
     public function __construct()
     {
         $this->middleware('auth');
         $this->source = 'EntryFormat/';
         $this->model = new EntryFormat();
         $this->routeName = 'entryformat.';
 
         $this->middleware("permission:{$this->module}.index")->only(['index', 'show']);
         $this->middleware("permission:{$this->module}.store")->only(['store', 'create']);
         $this->middleware("permission:{$this->module}.update")->only(['edit', 'update']);
         $this->middleware("permission:{$this->module}.delete")->only(['destroy']);
     }

    public function index(Request $request): Response
    {
        return Inertia::render("EntryFormat/Index", [
            'titulo'      => 'Formato de registro',
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EntryFormat $entryFormat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EntryFormat $entryFormat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EntryFormat $entryFormat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EntryFormat $entryFormat)
    {
        //
    }
}
