<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Module;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Response;
use Inertia\Inertia;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Contracts\Role;

class DoctorController extends Controller
{
    private Doctor $model;
    private string $routeName;
    private string $source;
    private string $module = 'doctor';
    public function __construct()
    {
        $this->middleware('auth');
        $this->source = 'Doctor/';
        $this->model = new Doctor();
        $this->routeName = 'doctores.';

        $this->middleware("permission:{$this->module}.index")->only(['index', 'show']);
        $this->middleware("permission:{$this->module}.store")->only(['store', 'create']);
        $this->middleware("permission:{$this->module}.update")->only(['edit', 'update']);
        $this->middleware("permission:{$this->module}.delete")->only(['destroy']);
    }

    public function index(Request $request): Response
    {
        $Doctor = $this->model;
        $Doctor = $Doctor->when($request->search, function ($query, $search) {
            if ($search != '') {
                $query->where('name',          'LIKE', "%$search%");
                $query->orWhere('status', 'LIKE', "%$search%");
            }
        })->paginate(7)->withQueryString();

        return Inertia::render("Doctor/Index", [
            'titulo'      => 'Docotores',
            'Doctor'    => $Doctor,
            'routeName'      => $this->routeName,
            'loadingResults' => false
        ]);

    }

    // Mostrar el formulario para crear una nueva especialidad
    public function create()
    {
        return Inertia::render("Doctor/Create", [
            'titulo'      => 'Crear usuario doctor',
            'routeName'      => $this->routeName,
        ]);
    }

    // Guardar una nueva especialidad en la base de datos
    public function store(Request $request)
    {
        //pendiente hacer la relacion con el usario
        // y el almacenarlos juntos
       

        Doctor::create([
            'nombre' => $request->input('nombre'),
            'licencia' => $request->input('licencia'),
            'fecha_registro' => $request->input('fecha_registro'),
            'descripcion' => $request->input('descripcion'),
            'estado' => $request->input('estado'),
            'nombre' => $request->input('nombre'),
            'especialidad_id' => $request->input('especialidad_id'),
            'user_id' => $request->input('user_id'),
        ]);
        return redirect()->route("doctores.index")->with('message', 'Doctor generado con éxito');
    
    }

    // Mostrar una especialidad específica
    public function show($id)
    {
        // Código para mostrar una especialidad específica
    }

    // Mostrar el formulario para editar una especialidad
    public function edit($id)
    {
        $Doctor= Doctor::find($id);
        return Inertia::render("Doctor/Edit", [
            'titulo'      => 'Modificar especialidad',
            'Doctor'    => $Doctor,
            'routeName'      => $this->routeName,
        ]);
    }

    // Actualizar una especialidad en la base de datos
    public function update(Request $request, $id)
    {
        $Doctor= Doctor::find($id);
        
        $Doctor->update($request->all());
          
        return redirect()->route("doctores.index")->with('success', 'Doctor actualizado correctamente!');
  
    }

    // Eliminar una especialidad
    public function destroy($id)
    {
        $Doctor= Doctor::find($id);
        $Doctor->delete();
        return redirect()->route("{$this->routeName}index")->with('success', 'Doctor eliminado con éxito');

    }
}
