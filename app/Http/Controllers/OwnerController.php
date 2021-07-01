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
        $request->validate($this->validationRules,[
            "correo" => ['required','email:rfc','unique:App\Models\Owner,correo']
        ]);
        //Si los datos son correctos creamos al duenio
        Owner::create($request->except(['_token','pet_id']));

        if($request->pet_id != 0){
            $pet = Pet::findOrFail($request->pet_id);
            return redirect()->route('pet.edit',$pet);
        }
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
        //Validando la nueva informacion del duenio
        $request->validate($this->validationRules,[
            "correo" => ['required','email:rfc'],
        ]);
        //Obteniendo la nueva informacion del usuario
        $ownerData = $request->except(['_token','_method', 'pet_id']);
        //Obteniendo el ID del usuario a editar
        $id = $owner->id;
        //Actualizando informacion del duenio
        Owner::where('id','=',$id)->update($ownerData);
        //Recuperando informacion del duenio actualizada
        $owner = Owner::findOrFail($id);
        //Recuperando la mascota con la que se estaba trabajando en la pagina
        $id = $pet->id;
        $pet = Pet::findOrFail($id);

        return redirect()->route('pet.edit',$pet);
    }
}
