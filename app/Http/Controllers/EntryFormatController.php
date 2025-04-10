<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntryFormatRequest;
use App\Models\Country;
use Illuminate\Support\Str;

use App\Models\EntryFormat;
use App\Models\Document;
use App\Models\Experience;
use App\Models\JobPosition;
use App\Models\Language;
use App\Models\LanguageLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

            $formats = EntryFormat::with(['experience', 'skills','desiredJobs','files'])
        ->when($request->search, function ($query, $search) {
            if ($search != '') {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('middle_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('mother_last_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('phone', 'LIKE', '%' . $search . '%')
                    ->orWhere('age', 'LIKE', '%' . $search . '%');
            }
        })
        ->orderBy($order, $direction)
        ->paginate(10)
        ->withQueryString();

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
        return Inertia::render("EntryFormat/Create", [
            'titulo'        => 'Format',
            'jobPositions'  => JobPosition::orderBy('name')->get(),
            'countries'     => Country::orderBy('name')->select('id','name')->get(),
            'languages'     => Language::orderBy('name')->select('id','name')->get(),
            'levels'        => LanguageLevel::orderBy('name')->select('id','name')->get(),
            'routeName'     => $this->routeName,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEntryFormatRequest $request)
    {
        try {
            $fields = $request->validated();
            $entryFormat = EntryFormat::create($fields);

            $entryFormat->skills()->sync($fields['skills']);
            $entryFormat->desiredJobs()->sync($fields['desires']);
            $entryFormat->experiences()->create($fields);

            $this->storageFiles($request, $entryFormat);

            return redirect()->route('welcome')->with('success', 'Registro creado con éxito');
        } catch (\Exception $e) {
            Log::error('Error form: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error form');
        }
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

    private function storageFiles(Request $request, EntryFormat $entryFormat)
    {
        $files = [
            'idFront'   => ['folder' => 'idFront',   'document_id' => 1],
            'idBack'    => ['folder' => 'idBack',    'document_id' => 2],
            'security'  => ['folder' => 'security',  'document_id' => 3],
            'selfie'    => ['folder' => 'selfie',    'document_id' => 4],
            'cv'        => ['folder' => 'cv',        'document_id' => 5],
            'signature' => ['folder' => 'documents', 'document_id' => 6],
        ];

        foreach ($files as $input => $config) {
            if ($request->hasFile($input)) {
                $file = $request->file($input);

                $fileName = "{$entryFormat->id}-{$file->getClientOriginalName()}.jpg";
                $filePath = $file->storeAs($config['folder'], $fileName, 'private');

                $entryFormat->files()->create([
                    'name'        => $fileName,
                    'path'        => $filePath,
                    'size'        => $file->getSize(),
                    'mime_type'   => $file->getMimeType(),
                    'document_id' => $config['document_id'],
                ]);
            }
        }
    }
}
