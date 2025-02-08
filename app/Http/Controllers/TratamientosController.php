<?php

namespace App\Http\Controllers;

use App\Models\Tratamientos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Response;
use Inertia\Inertia;

class TratamientosController extends Controller
{
    private Tratamientos $model;
    private string $routeName;
    private string $source;
    private string $module = 'tratamientos';
    public function __construct()
    {
        $this->middleware('auth');
        $this->source = 'Tratamientos/';
        $this->model = new Tratamientos();
        $this->routeName = 'tratamientos.';

        $this->middleware("permission:{$this->module}.index")->only(['index', 'show']);
        $this->middleware("permission:{$this->module}.store")->only(['store', 'create']);
        $this->middleware("permission:{$this->module}.update")->only(['edit', 'update']);
        $this->middleware("permission:{$this->module}.delete")->only(['destroy']);
    }

    public function index(Request $request): Response
    {
        $Tratamientos = $this->model;
        $Tratamientos = $Tratamientos->when($request->search, function ($query, $search) {
            if ($search != '') {
                $query->where('name',          'LIKE', "%$search%");
                $query->orWhere('status', 'LIKE', "%$search%");
            }
        })->paginate(7)->withQueryString();

        return Inertia::render("Tratamientos/Index", [
            'titulo'      => 'Catalogo de Tratamientos',
            'Tratamientos'    => $Tratamientos,
            'routeName'      => $this->routeName,
            'loadingResults' => false
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("Tratamientos/Create", [
            'titulo'      => 'Tratamientos',
            'routeName'      => $this->routeName,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Tratamientos::create([
            'nombre' => $request->input('nombre'),
            'precio' => $request->input('precio'),
            ]);
        return redirect()->route("tratamientos.index")->with('message', 'Tratamiento generado con éxito');
    
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Tratamientos $tratamientos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $Tratamientos= Tratamientos::find($id);
        return Inertia::render("Tratamientos/Edit", [
            'titulo'      => 'Modificar tratamientos',
            'Tratamientos'    => $Tratamientos,
            'routeName'      => $this->routeName,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $Tratamientos= Tratamientos::find($id);
        
        $Tratamientos->update($request->all());
          
        return redirect()->route("tratamientos.index")->with('success', 'Tratamiento actualizado correctamente!');
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Tratamientos= Tratamientos::find($id);
        $Tratamientos->delete();
        return redirect()->route("{$this->routeName}index")->with('success', 'Tratamiento eliminado con éxito');

    }
}
