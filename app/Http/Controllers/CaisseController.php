<?php

namespace App\Http\Controllers;

use App\Models\Caisse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class CaisseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (Auth::check()) {
            $products = DB::table("caisses")->orderByRaw("date desc")->get();
            return view('caisse.index', compact('products') );
        }else
            return view('home');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return(view('caisse.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate the input
        $request->validate([
            'libelle' => 'required',
            'date' => 'required',
            'recettes' => 'required',
            'depenses' => 'required',
            'solde' => 'required'
        ]);

        //create a new  in the
        Caisse::create($request->all());

        //redirect
        return redirect()->route('caisse.index')->with('success','La transacrtion est ajouté avec success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Caisse  $caisse
     * @return \Illuminate\Http\Response
     */
    public function show(Caisse $caisse)
    {
        //
        return view('caisse.show', compact('caisse') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Caisse  $caisse
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $caisse = Caisse::find($id);
        return view('caisse.edit',compact('caisse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Caisse  $caisse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $caisse = Caisse::find($id);
        $caisse->date = $request->input('date');
        $caisse->libelle = $request->input('libelle');
        $caisse->recettes = $request->input('recettes');
        $caisse->depenses = $request->input('depenses');
        $caisse->solde = $request->input('solde');
        $caisse->update();
        return redirect()->route('caisse.index')->with('success','La transaction est mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Caisse  $caisse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caisse $caisse)
    {
        //
        $caisse->delete();

        return redirect()->route('caisse.index')->with('success','La transaction est supprimée avec succès');
    }
}
