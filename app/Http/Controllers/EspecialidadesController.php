<?php

namespace App\Http\Controllers;
use App\Models\Especialidades;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Response;
use Inertia\Inertia;

class EspecialidadesController extends Controller
{
    
    private Especialidades $model;
    private string $routeName;
    private string $source;
    private string $module = 'especialidades';
    public function __construct()
    {
        $this->middleware('auth');
        $this->source = 'Especialidades/';
        $this->model = new Especialidades();
        $this->routeName = 'especialidades.';

        $this->middleware("permission:{$this->module}.index")->only(['index', 'show']);
        $this->middleware("permission:{$this->module}.store")->only(['store', 'create']);
        $this->middleware("permission:{$this->module}.update")->only(['edit', 'update']);
        $this->middleware("permission:{$this->module}.delete")->only(['destroy']);
    }

    public function index(Request $request): Response
    {
        $Especialidades = $this->model;
        $Especialidades = $Especialidades->when($request->search, function ($query, $search) {
            if ($search != '') {
                $query->where('name',          'LIKE', "%$search%");
                $query->orWhere('status', 'LIKE', "%$search%");
            }
        })->paginate(7)->withQueryString();

        return Inertia::render("Especialidades/Index", [
            'titulo'      => 'Catalogo de Especialidades',
            'Especialidades'    => $Especialidades,
            'routeName'      => $this->routeName,
            'loadingResults' => false
        ]);

    }

    // Mostrar el formulario para crear una nueva especialidad
    public function create()
    {
        return Inertia::render("Especialidades/Create", [
            'titulo'      => 'Especialidades',
            'routeName'      => $this->routeName,
        ]);
    }

    // Guardar una nueva especialidad en la base de datos
    public function store(Request $request)
    {
        Especialidades::create([
            'nombre' => $request->input('nombre'),
            
            ]);
        return redirect()->route("especialidades.index")->with('message', 'Especialidad generado con éxito');
    
    }

    // Mostrar una especialidad específica
    public function show($id)
    {
        // Código para mostrar una especialidad específica
    }

    // Mostrar el formulario para editar una especialidad
    public function edit($id)
    {
        $Especialidades= Especialidades::find($id);
        return Inertia::render("Especialidades/Edit", [
            'titulo'      => 'Modificar especialidad',
            'Especialidades'    => $Especialidades,
            'routeName'      => $this->routeName,
        ]);
    }

    // Actualizar una especialidad en la base de datos
    public function update(Request $request, $id)
    {
        $Especialidades= Especialidades::find($id);
        
        $Especialidades->update($request->all());
          
        return redirect()->route("especialidades.index")->with('success', 'Especialidad actualizada correctamente!');
  
    }

    // Eliminar una especialidad
    public function destroy($id)
    {
        $Especialidades= Especialidades::find($id);
        $Especialidades->delete();
        return redirect()->route("{$this->routeName}index")->with('success', 'Especialidad eliminada con éxito');

    }
}
