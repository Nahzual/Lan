<?php

namespace App\Http\Controllers;

use App\Lan;
use App\Material;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MaterialsController extends Controller{

		/**
		 * Show a list of the resource
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index($page=1,Request $request){
			if(Auth::check()){
				if(Auth::user()->isSiteAdmin()){
					if(isset($request->name_material)){
						$tm = Material::where('name_material','LIKE','%'.$request->name_material.'%')->orWhere('category_material','LIKE','%'.$request->name_material.'%')->selectRaw('COUNT(*) AS count')->first();
						if($tm!=null){
							$tm=$tm->count;
						}else{
							$tm=0;
						}
						$materials=Material::where('name_material','LIKE','%'.$request->name_material.'%')->orWhere('category_material','LIKE','%'.$request->name_material.'%')->skip(abs(($page - 1)*10))->take(10)->get();
					}else{
						$tm = Material::selectRaw('COUNT(*) AS count')->first();
						if($tm!=null){
							$tm=$tm->count;
						}else{
							$tm=0;
						}
						$materials=Material::skip(abs(($page - 1)*10))->take(10)->get();
					}

					$max = ceil($tm/10);

					if(($page+1)*10>($max*10)){
						$next = 0;
					}else{
						$next = $page + 1;
					}

					if($page == 1){
						$previous = 0;
					}else{
						$previous = $page-1;
					}

					if(isset($request->name_material)) return view('material.list',compact('materials','max','page','previous','next'))->with('name',$request->name_material);
					else return view('material.list',compact('materials','max','page','previous','next'));
				}else{
					return back()->with('error','You do not have enough rights.');
				}
			}else{
				return redirect('/login')->with('error','Please log in to have access to this page.');
			}
		}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
			if(Auth::check()){
				if(Auth::user()->isSiteAdmin()){
					return view('material.create');
				}else{
					return back()->with('error','You do not have enough rights.');
				}
			}else{
				return redirect('/login')->with('error','Please log in to perform this action.');
			}
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
			if($user->isSiteAdmin()){
				$material = new Material();

				$material->name_material=htmlentities($request->name_material);
				$material->desc_material=htmlentities($request->desc_material);
				$material->category_material=htmlentities($request->category_material);
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
	public function show($id){
		if(Auth::check()){
			$material=Material::find($id);
			if($material!=null){
				return view('material.show',compact('material'));
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
	public function edit($id){
		if(Auth::check()){
			$user=Auth::user();
			if($user->isSiteAdmin()){
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
	public function update(Request $request, $id){
		if(Auth::check()){
			$user=Auth::user();
			if($user->isSiteAdmin()){
				$material = Material::find($id);
				if($material!=null){

					$material->name_material=htmlentities($request->name_material);
					$material->desc_material=htmlentities($request->desc_material);
					$material->category_material=htmlentities($request->category_material);
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
    * Searches materials in the database whose name/category contains a string, and returns a view to list the materials
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
  */
	public function search(Request $request){
		if(Auth::check()){
			$user=Auth::user();
			$materials=Material::where('name_material','LIKE','%'.$request->name_material.'%')->orWhere('category_material','LIKE','%'.$request->name_material.'%')->get();
			if(isset($request->lan_id)){
				$lan=Lan::find($request->lan_id);
				if($lan!=null){
					return view($request->view_path,compact('materials','lan'));
				}else{
					return back()->with('error','This LAN does not exist.');
				}
			}else{
				return back()->with('error','Please provide a LAN.');
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
			if(Auth::user()->isSiteAdmin()){
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
