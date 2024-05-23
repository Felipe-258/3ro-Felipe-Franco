<?php

namespace App\Http\Controllers;

use App\Models\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateParameterRequest;
use Illuminate\Http\RedirectResponse;
class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parameter = Parameter::all()->first();
        /* dd($parameter); */
        return view('parameters.form', [
            'parameter' => $parameter
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParameterRequest $request, Parameter $parameter) :RedirectResponse 
    {
        /* dd($request->request->all()); */
        /* dd($parameter);
        $data = $request->except('_token');
        $parameter->update($data);
        dd($parameter); */
        $parameter = Parameter::where('id', $request->id)->first();
        /* dd($parameter); */
        if ($parameter) {
            $parameter->total = $request->total;
            $parameter->regular = $request->regular;
            $parameter->promocion  = $request->promocion;
            $parameter->save();
            return back()->withSuccess('Parameters are updated successfully.');
        }
        
    }

}
