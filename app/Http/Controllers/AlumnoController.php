<?php

namespace App\Http\Controllers;

use App\Http\Requests\Alumno\SubirDocumentoRequest;
use App\Providers\RouteServiceProvider;
use App\Models\Alumno;

class AlumnoController extends Controller
{
    public function store(SubirDocumentoRequest $request)
    {
        $documentoPath = $request->file('documento')->store('public/documentos');
        $data = $request->all();
        $data['documento'] = $documentoPath;
        Alumno::create($data);

        return redirect()->intended(RouteServiceProvider::ALUMNO);
    }
}
