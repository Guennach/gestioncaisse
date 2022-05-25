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
            'recettes' => 'required|numeric',
            'depenses' => 'required|numeric',
            'solde' => 'required|numeric'
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
        if (Auth::check()) {
            $caisse = Caisse::find($id);
            return view('caisse.edit',compact('caisse'));
        }else
            return view('auth.login')->with('alert','Login required !!');
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
       

        if (Auth::check()) {
             //Validate the input
             $request->validate([
                'libelle' => 'required',
                'date' => 'required',
                'recettes' => 'required|numeric',
                'depenses' => 'required|numeric',
                'solde' => 'required|numeric'
            ]);
            
            $caisse = Caisse::find($id);
            $caisse->date = $request->input('date');
            $caisse->libelle = $request->input('libelle');
            $caisse->recettes = $request->input('recettes');
            $caisse->depenses = $request->input('depenses');
            $caisse->solde = $request->input('solde');
            $caisse->update();
            return redirect()->route('caisse.index')->with('success','La transaction est mis à jour avec succès');
        }else{
            return view('auth.login')->with('alert','Login required !!');
        }
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
        if (Auth::check()) {
            $caisse->delete();
            return redirect()->route('caisse.index')->with('success','La transaction est supprimée avec succès');
        }else{
            return view('auth.login')->with('alert','Login required !!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function filter(Request $request)
    {
        $caisse = $request->all();
        if($caisse['start_date'] && $caisse['end_date']){
            $startDate = $caisse['start_date'];
            $endDate = $caisse['end_date'];
            $transactions = DB::table('caisses')->whereBetween(\DB::raw('DATE(date)'), [$startDate, $endDate])->get();
            return view('caisse.filter',compact('caisse'),compact('transactions'));
        }else
            return redirect(url()->previous())->with('alert','Please provide us with a start and end date to filter !!!!!!');
    }
    
   
}
