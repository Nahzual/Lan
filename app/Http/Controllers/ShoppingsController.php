<?php

namespace App\Http\Controllers;

use App\Lan;
use App\Shopping;
use App\Material;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ShoppingsController extends Controller{

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create($lanId){
		if(Auth::check()){
			$user=Auth::user();
			$lan=$user->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))
				->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($lanId);

			if($lan==null && !$user->isSiteAdmin()){
				return back()->with('error','You can\'t add an shopping to a LAN if you are not an admin or helper of this LAN.');
			}else{
				$lan=Lan::find($lanId);
				if($lan!=null){
					$materials = $lan->materials;
					$materials_array = array();
					foreach($materials as $material){
						$materials_array[$material->id]= ''.$material->name_material.'';
					}
					return view('shopping.create', compact('lan','materials_array'));
				}else{
					return back()->with('error','This LAN does not exist.');
				}
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
			$lan = $user->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))
				->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($lanId);

			if($lan==null && !$user->isSiteAdmin()){
				return back()->with('error','You can\'t add a shopping to a LAN you are not an admin or helper of.');
			}else{
				$lan=Lan::find($lanId);
				if($lan!=null){
					if(isset($request->material_id)){
						$material = Material::find($request->material_id);
						if($material!=null){
							if(isset($request->cost_shopping)){
								if(is_numeric($request->cost_shopping) && $request->cost_shopping>=0){
									if(isset($request->quantity_shopping)){
										if(is_numeric($request->quantity_shopping) && $request->quantity_shopping>0){
											$shopping = new Shopping();
											$shopping->cost_shopping = htmlentities($request->cost_shopping);
											$shopping->quantity_shopping = htmlentities($request->quantity_shopping);
											$shopping->material()->associate($material);
											$shopping->lan()->associate($lan);
											$shopping->save();

											return response()->json([
												'success'=>'Your shopping has been saved successfully.'
											]);
										}else{
											return response()->json(['error'=>'The quantity of material must be a positive number.']);
										}
									}else{
										return response()->json(['error'=>'Please provide the quantity of material.']);
									}
								}else{
									return response()->json(['error'=>'The shopping\'s cost must be 0 or a positive number.']);
								}
							}else{
								return response()->json(['error'=>'Please provide the shopping\'s cost.']);
							}
						}else{
							return response()->json(['error'=>'This material does not exist.']);
						}
					}else{
						return response()->json(['error'=>'Please provide a correct material.']);
					}
				}else{
					return response()->json(['error'=>'This LAN does not exist.']);
				}
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
	public function show($lanId, $shoppingId){
		if(Auth::check()){
			$user=Auth::user();

			$lan = $user->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))
				->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($lanId);

			if($lan!=null || $user->isSiteAdmin()){
				if($lan==null) $lan=Lan::find($lanId);

				if($lan!=null){
					$shopping=$lan->shoppings()->find($shoppingId);
					if($shopping!=null){
						$material = $shopping->material;
						if(Auth::check()){
							$userIsLanAdmin=Auth::user()->lans()->where('lan_user.lan_id','=',$lanId)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;
							return view('shopping.show', compact('lan', 'shopping', 'material', 'userIsLanAdmin'));
						}else{
							return view('shopping.show', compact('lan', 'shopping', 'material'));
						}
					}else{
						return back()->with('error','This shopping doesn\'t exist.');
					}
				}else{
					return back()->with('error','This LAN doesn\'t exist.');
				}
			}else{
				return back()->with('error','You must be an admin or helper of this LAN to view its shopping list.');
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
	public function edit($lanId, $shoppingId){
		if(Auth::check()){
			$user=Auth::user();

			$lan = $user->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))
				->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($lanId);

			if($lan==null && !$user->isSiteAdmin()){
				return back()->with('error','You can\'t edit a shopping list if you are not an admin or helper of its LAN.');
			}else{
				$lan=Lan::find($lanId);
				if($lan!=null){
					$shopping = $lan->shoppings()->find($shoppingId);
					if($shopping == null){
						return back()->with('error','This shopping list doesn\'t exist.');
					}else{
						$material = $shopping->material;
						return view('shopping.edit', compact('lan', 'shopping', 'material'));
					}
				}else{
					return back()->with('error','This LAN doesn\'t exist.');
				}
			}
		}else{
			return redirect('/login')->with('error','You must be logged in to edit a LAN\'s shopping list.');
		}
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $lanId, $shoppingId){
		if(Auth::check()){

			$user=Auth::user();
			$lan = $user->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))
				->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($lanId);

			if($lan==null && !$user->isSiteAdmin()){
				return response()->json(['error'=>'You can\'t edit an shopping if you are not an admin or helper of its LAN.']);
			}else{
				$lan=Lan::find($lanId);
				if($lan!=null){
					$shopping = $lan->shoppings()->find($shoppingId);
					if($shopping == null){
						return response()->json(['error'=>'This shopping doesn\'t exist.']);
					}else{
						$shopping->update($request->all());
						$shopping->save();
						return response()->json(['success'=>'This shopping has been successfully edited.']);
					}
				}else{
					return back()->with('error','This LAN doesn\'t exist.');
				}
			}
		}else{
			return response()->json(['error'=>'You must be logged in to edit a LAN\'s shopping list.']);
		}
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy($lanId, $shoppingId){
		if(Auth::check()){
			$user=Auth::user();
			$lan=$user->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))
							->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($lanId);
			
			if($lan==null && !$user->isSiteAdmin()){
				return response()->json(['error'=>'You can\'t edit a shopping list if you are not an admin or helper of its LAN.']);
			}else{
				$lan = Lan::find($lanId);
				if($lan!=null){
					$shopping = $lan->shoppings()->find($shoppingId);
					if($shopping == null){
						return response()->json(['error'=>'This shopping doesn\'t exist.']);
					}else{
						$shopping->delete();
						return response()->json(['success'=>'This shopping has been successfully deleted.']);
					}
				}else{
					return response()->json(['error'=>'This LAN doesn\'t exist.']);
				}
			}
		}else{
			return redirect('/login')->with('error','You must be logged in to edit a LAN\'s shopping list.');
		}
	}
}
