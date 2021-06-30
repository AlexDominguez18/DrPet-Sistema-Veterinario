<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class OwnerController extends Controller
{
    private $validationRules;

    public function __construct()
    {
        $this->validationRules = [
            "nombre" => ['required','string','min:5','max:100'],
            "telefono" => ['required','digits:10'],
            "correo" => ['required','email:rfc','unique:App\Models\Owner,correo'],
            "direccion" => ['required','string','min:5','max:50']
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validando los datos del formulario
        $request->validate($this->validationRules);
        
        //Si los datos son correctos creamos al duenio
        Owner::create($request->all());

        $owners = Owner::get();
        return redirect()->route('pet.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Owner $owner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Owner $owner, Pet $pet)
    {
        $ownerData = $request->except(['_token','_method']);
        $id = $owner->id;
        
        Owner::where('id','=',$id)->update($ownerData);
        $owner = Owner::findOrFail($id);
        
        $owners = Owner::get();

        $id = $pet->id;
        $pet = Pet::findOrFail($id);

        return redirect()->route('pet.edit',$pet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Owner  $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Owner $owner)
    {
        //
    }
}
