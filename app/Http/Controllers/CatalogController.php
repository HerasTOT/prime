<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\Inertia;

class CatalogController extends Controller
{
    private Catalog $model;
    private string $routeName;
    private string $source;
    private string $module = 'catalog';
    
    public function __construct()
    {
       
       $this->source = 'Catalog/';
        $this->model = new Catalog();
        $this->routeName = 'catalog.';

         $this->middleware("permission:{$this->module}.index")->only(['index', 'show']);
         $this->middleware("permission:{$this->module}.store")->only(['store', 'create']);
         $this->middleware("permission:{$this->module}.update")->only(['edit', 'update']);
         $this->middleware("permission:{$this->module}.delete")->only(['destroy']);
  
   }
   public function index(Request $request): Response
{
    
         // Establecer dirección de ordenamiento por defecto
         $direction = $request->has('direction') ? $request->direction : 'desc';
         
         // Establecer campo de ordenamiento por defecto
         $order = $request->has('order') ? $request->order : 'created_at';
     
         // Iniciar la consulta sobre el modelo EntryFormat
         $catalogs = Catalog::query();
     
         // Filtrar por búsqueda si se pasa el parámetro 'search'
         $catalogs = $catalogs->when($request->search, function ($query, $search) {
             if ($search != '') {
                 $query->where('name', 'LIKE', '%' . $search . '%');
             }
         });
     
         // Ordenar los resultados según los parámetros 'order' y 'direction'
         $catalogs = $catalogs->orderBy($order, $direction);
     
         // Paginación de los resultados
         $catalogs = $catalogs->paginate(10)->withQueryString();

    return Inertia::render("Catalog/Index", [
        'title'     => 'Work Catalog',
        'routeName' => $this->routeName,
        'catalog'   => $catalogs, // Aquí usamos paginate()
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
    public function show(Catalog $catalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Catalog $catalog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Catalog $catalog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Catalog $catalog)
    {
        //
    }
}
