<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use Illuminate\Http\Request;
use App\Rules\MatchPassword;

class TreatmentController extends Controller
{
    private $validationRules;

    public function __construct()
    {
        $this->validationRules = [
            "nombre" => ['required','min:5','max:50'],
            "dosis" => ['required','numeric','min:1','max:999'],
            "fecha_caducidad" => ['required','after:today'],
            "tipo" => ['required','in:medicina,vacuna'],
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $treatments = Treatment::get();

        return view('treatments.treatmentList',compact(['treatments']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('treatments.newTreatment');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validationRules);
        
        Treatment::create($request->all());

        return redirect()->route('treatment.index')->with('message','¡Tratamiento añadido con éxito!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function show(Treatment $treatment)
    {
        return view('treatments.treatmentShow',compact(['treatment']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function edit(Treatment $treatment)
    {
        return view('treatments.treatmentEdit',compact(['treatment']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Treatment $treatment)
    {
        $request->validate($this->validationRules);

        $treatmentData = $request->except('_token','_method');

        Treatment::where('id',$treatment->id)->update($treatmentData);

        return redirect()->route('treatment.index')->with('message','¡Información de tratamiento actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Treatment  $treatment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Treatment $treatment)
    {
        $request->validate([
            'password' => ['required', new MatchPassword]
        ]);

        Treatment::destroy($treatment->id);

        return redirect()->route('treatment.index')->with('message','¡Tratamiento eliminado con éxito!');
    }
}
