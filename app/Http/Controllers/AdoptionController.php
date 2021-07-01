<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Pet;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pet::where('adoptable', true)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // I think it will not be used
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pet_id = $request->pet_id;
        Adoption::create($pet_id);
        Pet::where('id', $pet_id)->update(['adoptable' => false]);
        return Pet::where('id', $pet_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adoption  $adoption
     * @return \Illuminate\Http\Response
     */
    public function show(Adoption $adoption)
    {
        return $adoption;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adoption  $adoption
     * @return \Illuminate\Http\Response
     */
    public function edit(Adoption $adoption)
    {
        // Not used
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adoption  $adoption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Adoption $adoption)
    {
        // Not used
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adoption  $adoption
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adoption $adoption)
    {
        $adoption->delete();
        return redirect()->route('adoptions.index');
    }
}
