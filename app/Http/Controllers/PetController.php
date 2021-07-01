<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Owner;
use App\Models\Specie;
use App\Rules\MatchPassword;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    private $validationRules;

    public function __construct()
    {
        $this->validationRules = [
            "nombre" => ['required','string','min: 3','max:30'],
            "raza" => ['required','string','min:5','max:50'],
            "color" => ['required','string','min:3','max:25'],
            "specie_id" => ['required','exists:App\Models\Specie,id'],
            "observaciones" => ['required','min:5'],
            "sexo" => ['required'],
            "foto" => ['image','max:5120'],
            "owner_id" => ['exists:App\Models\Owner,id']
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pets = Pet::get();
        $species = Specie::get();
        return view('pets.petList',compact(['pets','species']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owners = Owner::get();
        $species = Specie::get();
        return view('pets.newPet', compact(['owners','species']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validando los campos llenados
        $request->validate($this->validationRules,[
            "fecha_consulta" => ['required','after:yesterday']
        ]);

        //Si los campos estan bien, creamos a la mascota
        $petData = $request->except('_token');

        if ($request->hasFile('foto')){
            $petData['foto'] = $request->file('foto')->store('uploads','public');
        }else{
            $petData['foto'] = 'img/PetAvatarDefault.png';
        }

        Pet::insert($petData);

        return redirect()->route('pet.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        return view('pets.showPet',compact(['pet']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function edit(Pet $pet)
    {
        $owners = Owner::get();
        $owner = $pet->owner;
        $species = Specie::get();
        return view('pets.petEdit',compact(['pet','owners','owner','species']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pet $pet)
    {
        //Validando la nueva informacion
        $request->validate($this->validationRules);
        //Recolectando la informacion del request
        $petData = $request->except(['_token','_method']);
        //Obteniendo el ID de la amscota editada
        $id = $pet->id;
        //Checando la existencia de la foto
        if ($request->hasFile('foto')){
            $pet = Pet::findOrFail($id);
            Storage::delete('public/'.$pet->foto);
            $petData['foto'] = $request->file('foto')->store('uploads','public');
        }
        //Actualizando la informacion de la mascota
        Pet::where('id','=',$id)->update($petData);
        //Si un duenio ya no tiene mascotas lo podemos eliminar
        if (Owner::find($pet->owner_id)->pets->isEmpty()){
            Owner::destroy(Owner::find($pet->owner_id)->id);
        }
        //Recuperando a la mascota para mostrar su informacion actualizada
        $pet = Pet::findOrFail($id);

        return redirect()->route('pet.edit',$pet);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pet  $pet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pet $pet)
    {
        //Validando que la contrasenia sea la correcta
        $request->validate([
            'password' => ['required', new MatchPassword]
        ]);
        //Si la foto de la mascota no es la predeterminada, la eliminamos del storage
        if ($pet->foto !== 'img/PetAvatarDefault.png'){
            Storage::delete('public/'.$pet->foto);
        }

        //Eliminando el registro de la mascota con el ID correspondiente
        Pet::destroy($pet->id);

        //Si ya un duenio ya no tiene mascotas lo podemos eliminar
        if (Owner::find($pet->owner_id)->pets->isEmpty()){
            Owner::destroy(Owner::find($pet->owner_id)->id);
        }

        return redirect()->route('pet.index');
    }
}
