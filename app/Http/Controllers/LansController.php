<?php

namespace App\Http\Controllers;

use App\Lan;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lans = Auth::user()->lans;
		
		return view('home', compact('lans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$lan = new Lan();
		$lan->name = $request->name;
		$lan->max_num_registrants = $request->max_num_registrants;
		$lan->opening_date = $request->opening_date;
		$lan->duration = $request->duration;
		$lan->budget = $request->budget;
		$lan->save();
		
		$lan->users()->attach(Auth::user()->id, ['rank_lan' => 1, 'score_lan' => 0]);
		
		return response()->json([
		'success'=>'Votre Lan a été correctement enregistrées'
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$lan = Auth::user()->lans()->findOrFail($id);
		
		return view('lan.show', compact('lan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$lan = Auth::user()->lans()->findOrFail($id);
		
		return view('lan.edit', compact('lan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$lan = Auth::user()->lans()->findOrFail($id);
		
		//Met à jour la lan 
		$lan->update($request->all());
		$lan->save();
		
        return redirect(route('lan.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$lan = Auth::user()->lans()->findOrFail($id);
		
		//Supprime le bateau
		$lan->delete();
		return redirect(route('lan.index'));
    }
}
