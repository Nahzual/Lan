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
	public function edit($lanId, $shoppingId)
    {
		if(Auth::check()){
  			$user=Auth::user();
  			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && !$user->isSiteAdmin()){
  				return back()->with('error','You can\'t edit an Shopping if you are not an admin of its LAN.');
  			}else{
					$lan = Lan::find($lanId);
					if($lan!=null){
						$shopping = $lan->shoppings()->find($shoppingId);
						$material = $shopping->materials()->first();
						if($shopping == null){
							return back()->with('error','This Shopping doesn\'t exist.');
						}else{
							return view('shopping.edit', compact('lan', 'shopping', 'material'));
						}
					}else{
						return back()->with('error','This LAN doesn\'t exist.');
					}
  			}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to edit a LAN\'s shopping.');
  		}
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function update(Request $request, $lanId, $shoppingId)
    {
			if(Auth::check()){
	  		$user=Auth::user();
	  		if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($lanId)==null && !$user->isSiteAdmin()){
	  			return response()->json(['error'=>'You can\'t edit an shopping if you are not an admin of its LAN.']);
	  		}else{
					$lan = Lan::find($lanId);
					if($lan!=null){
						$shopping = $lan->shoppings()->find($shoppingId);
						$material = $shopping->material()->first();
						if($shopping == null || $material == null){
							return response()->json(['error'=>'This shopping doesn\'t exist.']);
						}else{
							$shopping->update($request->all());
							$shopping->save();
							$material->update($request->all());
							$material->save();
							return response()->json(['success'=>'The shopping "'.$material->name_material.'" has been successfully edited.']);
						}
					}else{
						return back()->with('error','This LAN doesn\'t exist.');
					}
	  		}
	  	}else{
	  		return redirect('/login')->with('error','You must be logged in to edit a LAN\'s shopping.');
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
