<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use App\Models\EntryFormat;
use App\Models\Catalog;
use App\Models\Document;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        
        $this->source = 'EntryFormat/';
         $this->model = new EntryFormat();
         $this->routeName = 'entryformat.';
 
          $this->middleware("permission:{$this->module}.index")->only(['index', 'show']);
    //    $this->middleware("permission:{$this->module}.store")->only(['store', 'create']);
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
         $formats = $formats->paginate(10)->withQueryString();
         

         

         return Inertia::render("EntryFormat/Index", [
             'title'       => 'Formato de Registro',
             'routeName'   => $this->routeName,
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
        $catalog = Catalog::select('id', 'name')->get();

        return Inertia::render("EntryFormat/Create",[
            'titulo'      => 'Format',
            'catalog'     => $catalog,
            'routeName'      => $this->routeName,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    
   
    

    $entryFormat = EntryFormat::create([
        'name' => $request->input('name'),
        'secondName' => $request->input('secondName'),
        'lastName' => $request->input('lastName'),
        'secondLastname' => $request->input('secondLastname'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'age' => $request->input('age'),
        'birthdate' => $request->input('birthdate'),
        'ssn' => $request->input('ssn'),
    ]);
    
    //mejorar logica
    $entryFormatId = $entryFormat->id;
    $catalogIds = $request->catalog_ids; // Array de IDs
    $positionIds = $request->position_interested;


    // Insertar los datos en la tabla pivot "user_jobs"
    foreach ($catalogIds as $catalogId) {
        DB::table('user_jobs')->insert([
            'job' => $catalogId,
            'entryformat_id' => $entryFormatId, // Ahora relacionamos con entry_formats correctamente
            'type' => 'previous', // Tipo siempre "previous"
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    foreach ($positionIds as $positionId) {
        DB::table('user_jobs')->insert([
            'job' => $positionId,
            'entryformat_id' => $entryFormatId, 
            'type' => 'interested', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    Experience::create([
        'entryformat_id' => $entryFormatId,
        'company' => $request->input('company'),
        'position' => $request->input('position'),
        'address' => $request->input('address'),
        'supervisor' => $request->input('supervisor'),
        'company_phone' => $request->input('company_phone'),
        'salary' => $request->input('salary'),
        'start_date' => $request->input('start_date'),
        'end_date' => $request->input('end_date'),
        'termination_reason' => $request->input('termination_reason'),
    ]);


    if ($request->hasFile('idFront')) {
        $file = $request->file('idFront');

        // Generar un nombre aleatorio con la extensión original
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        // Guardar el archivo en storage/app/id/
        $path = $file->storeAs('id', $filename);

        // Guardar la misma imagen en todas las columnas
        $document = Document::create([
            'idFront'   => $path,
            'idBack'    => $path,
            'security'  => $path,
            'selfie'    => $path,
            'cv'        => $path,
            'signature' => $path,
            'date' => now()->format('Y-m-d H:i:s'),
            'entryformat_id'=> $entryFormatId
        ]);

        return response()->json(['message' => 'Archivo guardado con éxito', 'path' => $path]);
    }

    return response()->json(['error' => 'No se recibió ningún archivo'], 400);


    return redirect()->route("welcome")->with('message', 'Registro creado con éxito');
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
