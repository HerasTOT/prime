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
        $this->middleware("permission:{$this->module}.store")->only(['store', 'create']); 
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
         // Establecer dirección de ordenamiento por defecto
         $direction = $request->has('direction') ? $request->direction : 'desc';
         
         // Establecer campo de ordenamiento por defecto
         $order = $request->has('order') ? $request->order : 'created_at';
     
         // Iniciar la consulta sobre el modelo EntryFormat
         $formats = EntryFormat::query();
     
         // Filtrar por búsqueda si se pasa el parámetro 'search'
         $formats = $formats->when($request->search, function ($query, $search) {
             if ($search != '') {
                 $query->where('name', 'LIKE', '%' . $search . '%')
                     ->orWhere('paternalSurname', 'LIKE', '%' . $search . '%')
                     ->orWhere('maternalSurname', 'LIKE', '%' . $search . '%')
                     ->orWhere('email', 'LIKE', '%' . $search . '%')
                     ->orWhere('phone', 'LIKE', '%' . $search . '%');
             }
         });
     
         // Ordenar los resultados según los parámetros 'order' y 'direction'
         $formats = $formats->orderBy($order, $direction);
     
         // Paginación de los resultados
         $formats = $formats->paginate(10)->withQueryString();
     
         // Pasar los datos a la vista
         return Inertia::render("EntryFormat/Index", [
             'title'      => 'Formato de Registro',
             'routeName' => $this->routeName,
             'format'      => $formats,
             'search'      => $request->search ?? '',
             'order'       => $order,
             'direction'   => $direction,
         ]);
     }
     

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return Inertia::render("EntryFormat/Create",[
            'titulo'      => 'Formulario',
            'routeName'      => $this->routeName,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // $request->validate([
    //     'name' => 'required|string|max:255',
    //     'paternalSurname' => 'required|string|max:255',
    //     'maternalSurname' => 'required|string|max:255',
    //     'email' => 'required|email|max:255|unique:entry_formats,email',
    //     'phone' => 'required|string|max:20',
    //     'age' => 'required|integer|min:0',
    //     'birthdate' => 'required|date',
    //     'ssn' => 'required|string|max:20|unique:entry_formats,ssn',
    // ]);

    EntryFormat::create([
        'name' => $request->input('name'),
        'paternalSurname' => $request->input('paternalSurname'),
        'maternalSurname' => $request->input('maternalSurname'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'age' => $request->input('age'),
        'birthdate' => $request->input('birthdate'),
        'ssn' => $request->input('ssn'),
    ]);

    return redirect()->route("entryformat.index")->with('message', 'Registro creado con éxito');
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
