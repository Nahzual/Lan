<?php

namespace App\Http\Controllers;

use App\Lan;
use App\Shopping;
use App\Material;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ShoppingsController extends Controller
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
			return view('shopping.index',compact('user'));
		}else{
			return redirect('/login')->with('error','Please log in to have access to this page.');
		}
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($lanId)
    {
		if(Auth::check()){
  			$user=Auth::user();
  			if($user->lans()->find($lanId)==null && !$user->isSiteAdmin()){
  				return back()->with('error','You can\'t add an shopping to a LAN you are not an admin of.');
  			}else{
				$lan = $user->lans()->find($lanId);
				$materials = $lan->materials;
				$materials_array = array();
				foreach($materials as $material){
					$materials_array[$material->id]= ''.$material->name_material.'';
				}
  				return view('shopping.create', compact('lan','materials_array'));
  			}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to edit a LAN.');
  		}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	public function store(Request $request, $lanId){

		if(Auth::check()){
  			$user=Auth::user();
  			if($user->lans()->find($lanId)==null && !$user->isSiteAdmin()){
  				return back()->with('error','You can\'t add an shopping to a LAN you are not an admin of.');
  			}else{
				$lan = $user->lans()->find($lanId);
				if($request->has('name_material') && $request->has('desc_material') && $request->has('category_material')){
					$material = new Material();
					$material->name_material = htmlentities($request->name_material);
					$material->desc_material = htmlentities($request->desc_material);
					$material->category_material = htmlentities($request->category_material);
					$material->save();
				}else{
					$material = Material::Find($request->material_id);
				}
				$shopping = new Shopping();
				$shopping->cost_shopping = htmlentities($request->cost_shopping);
				$shopping->quantity_shopping = htmlentities($request->quantity_shopping);
				$shopping->save();
				$shopping->materials()->attach($material->id);
				$shopping->lans()->attach($lanId);

				return response()->json([
					'success'=>'Your shopping has been saved successfully.'
				]);
  			}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to edit a LAN.');
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
			$shopping=Shopping::find($id);
			if($shopping!=null){
				$user=Auth::user();
				return view('shopping.show',compact('shopping','user'));
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
				$shopping=Shopping::find($id);
				if($shopping!=null){
					return view('shopping.edit',compact('shopping'));
				}else{
					return redirect('/home')->with('error','This shopping does not exist.');
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


	public function search(Request $request){
		if(Auth::check()){
			$user=Auth::user();
			$shoppings=Shopping::where('name_material','LIKE','%'.$request->name_material.'%')->get();
			if(isset($request->lan_id)){
				$lan=Lan::find($request->lan_id);
				if($lan!=null){
					return view($request->view_path,compact('materials','user','lan'));
				}else{
					return "<p>This LAN doesn\'t exist</p>";
				}
			}
		}else{
			return redirect('/login')->with('error','Please log in to have access to this page.');
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
				$shopping=Shopping::find($id);

				// todo destroy material, then shopping

				/*if($material!=null){
					$material->delete();
					return response()->json(['success'=>'This material has been successfully deleted.']);
				}else{
					return response()->json(['error'=>'This material does not exist.']);
				}*/
			}else{
				return response()->json(['error','You do not have enough rights to do this.']);
			}
		}else{
			return response()->json(['error'=>'Please log in to perform this action.']);
		}
	}

}
