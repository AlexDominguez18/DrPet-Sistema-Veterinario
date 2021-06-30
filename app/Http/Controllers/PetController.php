<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Owner;
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
            "especie" => ['required'],
            "fecha_consulta" => ['required','after:yesterday'],
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
        return view('layouts.listaMascotas',compact(['pets']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $owners = Owner::get();
        return view('layouts.nuevaMascota', compact(['owners']));
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
        $request->validate($this->validationRules);
        
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
        return view('layouts.mostrarMascota',compact(['pet']));
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
        return view('layouts.editarMascota',compact(['pet','owners','owner']));
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
        $petData = $request->except(['_token','_method']);
        $id = $pet->id;

        //Checando la existencia de la foto
        if ($request->hasFile('foto')){
            $pet = Pet::findOrFail($id);
            Storage::delete('public/'.$pet->foto);
            $petData['foto'] = $request->file('foto')->store('uploads','public');
        }

        Pet::where('id','=',$id)->update($petData);
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
        $request->validate([
            'password' => ['required', new MatchPassword]
        ]);

        if ($pet->foto !== 'img/PetAvatarDefault.png'){
            Storage::delete('public/'.$pet->foto);
        }

        Pet::destroy($pet->id);
        
        //Si ya un duenio ya no tiene mascotas lo podemos eliminar
        if (Owner::find($pet->owner_id)->pets->isEmpty()){
            Owner::destroy(Owner::find($pet->owner_id)->id);
        }

        return redirect()->route('pet.index');
    }
}
