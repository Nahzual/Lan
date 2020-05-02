<?php

namespace App\Http\Controllers;

use App\Lan;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index()
	{
		if(Auth::check()){
			$user=Auth::user();
			return view('material.index',compact('user'));
		}else{
			return redirect('/login')->with('error','Please log in to have access to this page.');
		}
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('material.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function store(Request $request){

		if(Auth::check()){
			$user=Auth::user();
			if($user->rank_user==config('ranks.ADMIN')){
				$material = new Material();

				if($request->price_material >= 0) $material->price_material=$request->price_material;
				else return response()->json(['error'=>'The price has to be positive or zero.']);

				$material->name_material=htmlentities($request->name_material);
				$material->desc_material=htmlentities($request->desc_material);
				$material->save();

				return response()->json(['success'=>'The material "'.$material->name_material.'" has been successfully created.']);

			}else{
				return response()->json(['error'=>'You do not have enough rights to do this.']);
			}
		}else{
			return response()->json(['error'=>'Please log in to perform this action.']);
		}
	}


      /**
       * Display the specified resource.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
	public function show($id)
		{
		if(Auth::check()){
			$material=Material::find($id);
			if($material!=null){
				$user=Auth::user();
				return view('material.show',compact('material','user'));
			}else{
				return redirect('/login')->with('error','Please log in to have access to this page.');
			}
		}else{
			return redirect('/login')->with('error','Please log in to have access to this page.');
		}
	}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function edit($id)
	{
		if(Auth::check()){
			$user=Auth::user();
			if($user->rank_user==config('ranks.ADMIN')){
				$material=Material::find($id);
				if($material!=null){
					return view('material.edit',compact('material'));
				}else{
					return redirect('/home')->with('error','This material does not exist.');
				}
			}else{
				return redirect('/home')->with('error','You do not have enough rights to do this.');
			}
		}else{
			return redirect('/login')->with('error','Please log in to perform this action.');
		}
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
		if(Auth::check()){
			$user=Auth::user();
			if($user->rank_user==config('ranks.ADMIN')){
				$material = Material::find($id);
				if($material!=null){
					if($request->price_material >= 0) $material->price_material=$request->price_material;
					else return response()->json(['error'=>'The price has to be positive or zero.']);
					$material->name_material=htmlentities($request->name_material);
					$material->desc_material=htmlentities($request->desc_material);
					$material->save();

					return response()->json(['success'=>'The material "'.$material->name_material.'" has been successfully edited.']);
				}else{
					return response()->json(['error'=>'This material does not exist.']);
				}
			}else{
				return response()->json(['error','You do not have enough rights to do this.']);
			}
		}else{
			return response()->json(['error','Please log in to perform this action.']);
		}
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroy($id){
		if(Auth::check()){
			if(Auth::user()->rank_user==config('ranks.SITE_ADMIN')){
				$material=Material::find($id);
				if($material!=null){
					$material->delete();
					return response()->json(['success'=>'This material has been successfully deleted.']);
				}else{
					return response()->json(['error'=>'This material does not exist.']);
				}
			}else{
				return response()->json(['error','You do not have enough rights to do this.']);
			}
		}else{
			return response()->json(['error'=>'Please log in to perform this action.']);
		}
	}

}
