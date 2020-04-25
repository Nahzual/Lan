<?php

namespace App\Http\Controllers;

use App\Lan;
use App\Location;
use App\City;
use App\Street;
use App\Department;
use App\Country;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
      if(Auth::check()){
        $user = Auth::user();
        $admin_lans = $user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->get();
        $helper_lans = $user->lans()->where('lan_user.rank_lan','=',config('ranks.HELPER'))->get();
        $player_lans = $user->lans()->where('lan_user.rank_lan','=',config('ranks.PLAYER'))->get();

        if($user->rank_user==config('ranks.SITE_ADMIN')){
			       $waiting_lans = Lan::where('waiting_lan','=',config('waiting.WAITING'))->get();
			       return view('dashboard.admin.index', compact('admin_lans','helper_lans','player_lans', 'user','waiting_lans'));
        }else return view('dashboard.index', compact('admin_lans','helper_lans','player_lans', 'user'));
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
        if(Auth::check()){
          return view('lan.create');
        }else{
          return redirect('/login')->with('error','You have to be logged in to create a new LAN.');
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
         //Country
     		$countries = Country::where('name_country','=',$request->name_country)->get();
     		if($countries != null){$country = $countries->first();}
     		if(!isset($country)){
     			$country = new Country();
     			$country->name_country = $request->name_country;
     			$country->save();
     			//$country = Country::findOrFail($country->id);
     		}else{
     			$departments = $country->departments;
     		}
     		//Department
     		if(isset($departments)){
     			foreach($departments as $tdepartment){
     				if($tdepartment->name_department == $request->name_department){
     					$department = $tdepartment;
     					break;
     				}
     			}
     		}
     		if(!isset($department)){
     			$department = new Department();
     			$department->name_department = $request->name_department;
     			$department->country()->associate($country);
     			$department->save();
     			//$department = Department::findOrFail($department->id);
     		}else{
     			$cities = $department->cities;
     		}

     		//City
     		if(isset($cities)){
     			foreach($cities as $tcity){
     				if($tcity->name_city == $request->name_city && $tcity->zip_city == $request->zip_city){
     					$city = $tcity;
     					break;
     				}
     			}
     		}
     		if(!isset($city)){
     			$city = new City();
     			$city->name_city = $request->name_city;
     			$city->zip_city = $request->zip_city;
     			$city->department()->associate($department);
     			$city->save();
     			//$city = City::findOrFail($city->id);
     		}else{
     			$streets = $city->streets;
     		}

     		//Street
     		if(isset($streets)){
     			foreach($streets as $tstreet){
     				if($tstreet->name_street == $request->name_street){
     					$street = $tstreet;
     					break;
     				}
     			}
     		}
     		if(!isset($street)){
     			$street = new Street();
     			$street->name_street = $request->name_street;
     			$street->city()->associate($city);
     			$street->save();
     			//$street = Street::findOrFail($street->id);
     		}else{
     			$locations = $street->locations;
     		}

     		//Location
     		if(isset($locations)){
     			foreach($locations as $tlocation){
     				if($tlocation->num_street == $request->num_location){
     					$location = $tlocation;
     					break;
     				}
     			}
     		}
     		if(!isset($location)){
     			$location = new Location();
     			$location->num_street = $request->num_location;
     			$location->street()->associate($street);
     			$location->save();
     			//$location = Location::findOrFail($location->id);
     		}

     		$lan = new Lan();
     		$lan->name = $request->name;
     		$lan->max_num_registrants = $request->max_num_registrants;
     		$lan->opening_date = $request->opening_date;
     		$lan->duration = $request->duration;
     		$lan->budget = $request->budget;
         $lan->room_width = $request->room_width;
         $lan->room_length = $request->room_length;
     		$lan->location()->associate($location);
     		$lan->save();

     		$lan->users()->attach(Auth::user()->id, ['rank_lan' => config('ranks.ADMIN'), 'score_lan' => 0, 'place_number' => 0]);

     		return response()->json([
     		    'success'=>'Your LAN has been saved successfully.'
     		]);
      }else{
        return response()->json([
     		    'error'=>'Please log in to perform this action.'
     		]);
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
  			$lan = Lan::findOrFail($id);
  			$location = $lan->location;
  			$street = $location->street;
  			$city = $street->city;
  			$department = $city->department;
  			$country = $department->country;
        if(Auth::check() && ($user=Auth::user())->lans()->where('lans.id','=',$lan->id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null){
          $helpers=$lan->users()->where('lan_user.rank_lan','=',config('ranks.HELPER'))->get();
          $admins=$lan->users()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->get();
          return view('lan.show', compact('lan', 'location', 'street', 'city', 'department', 'country','helpers','admins'))->with(['userIsLanAdmin'=>true]);
        }else{
          return view('lan.show', compact('lan', 'location', 'street', 'city', 'department', 'country'))->with(['userIsLanAdmin'=>false]);
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
  			if($user->lans()->find($id)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
  				return back()->with('error','You can\'t edit a LAN for which you are not an admin.');
  			}else{
  				$lan = Lan::findOrFail($id);
          $location = $lan->location;
    			$street = $location->street;
    			$city = $street->city;
    			$department = $city->department;
    			$country = $department->country;
  				return view('lan.edit', compact('lan', 'location', 'street', 'city', 'department', 'country'));
  			}
  		}else{
  			return redirect('/login')->with('error','You must be logged in to edit a LAN.');
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
  			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
          return response()->json(['error'=>'You have to be an admin of this LAN to edit it.']);
  			}else{
  				$lan = Lan::findOrFail($id);
  				$lan->update($request->all());
          $location = $lan->location;
          $lan_location=$location;
    			$street = $location->street;
          $lan_street=$street;
    			$city = $street->city;
          $lan_city=$city;
    			$department = $city->department;
          $lan_department=$department;
    			$country = $department->country;
          $lan_country=$country;

          //Country
          if(isset($request->name_country) && $request->name_country!=$country->name_country){

            $countries = Country::where('name_country','=',$request->name_country)->get();
            if($countries != null){$country = $countries->first();}
            if(!isset($country)){
              $country = new Country();
              $country->name_country = $request->name_country;
              $country->save();
            }
          }

      		//Department
          if(isset($request->name_department) && $request->name_department!=$department->name_department){

            $departments=$country->departments;
            $department=null;
            if(isset($departments)){
        			foreach($departments as $tdepartment){
        				if($tdepartment->name_department == $request->name_department){
        					$department = $tdepartment;
        					break;
        				}
        			}
        		}
          }

      		if(!isset($department) || $country!=$lan_country){
      			$department = new Department();
      			$department->name_department = $request->name_department;
      			$department->country()->associate($country);
      			$department->save();
      		}

      		//City
          if(isset($request->name_city) && ($request->name_city!=$city->name_city || $request->zip_city!=$city->zip_city)){
            $cities=$department->cities;
            $city=null;

            if(isset($cities)){
        			foreach($cities as $tcity){
        				if($tcity->name_city == $request->name_city && $tcity->zip_city == $request->zip_city){
        					$city = $tcity;
        					break;
        				}
        			}
        		}
          }

          if(!isset($city) || $department!=$lan_department){
      			$city = new City();
      			$city->name_city = $request->name_city;
      			$city->zip_city = $request->zip_city;
      			$city->department()->associate($department);
      			$city->save();
      		}

      		//Street
          if(isset($request->name_street) && $request->name_street!=$street->name_street){
            $streets=$city->streets;
            $street=null;

            if(isset($streets)){
        			foreach($streets as $tstreet){
        				if($tstreet->name_street == $request->name_street){
        					$street = $tstreet;
        					break;
        				}
        			}
        		}
          }

      		if(!isset($street) || $city!=$lan_city){
      			$street = new Street();
      			$street->name_street = $request->name_street;
      			$street->city()->associate($city);
      			$street->save();
      		}

          if(isset($request->num_street) && $request->num_street!=$location->num_street){
            $locations=$street->locations;
            $location=null;

        		//Location
        		if(isset($locations)){
        			foreach($locations as $tlocation){
        				if($tlocation->num_street == $request->num_street){
        					$location = $tlocation;
        					break;
        				}
        			}
        		}
          }

      		if(!isset($location) || $street!=$lan_street){
      			$location = new Location();
      			$location->num_street = $request->num_street;
      			$location->street()->associate($street);
      			$location->save();
      		}

          if($location!=$lan_location) $lan->location()->associate($location);
  				$lan->save();

  				return response()->json(['success'=>'Your LAN has been successfully edited.']);
  			}
  		}else{
        return response()->json(['error'=>'Please login to perform this action.']);
  		}
    }

    public function participate($id){
      if(Auth::check()){
        $lan=Lan::findOrFail($id);

        return view('lan.participate',compact('lan'));
      }else{
        return redirect('/login')->with('error','You must be logged in to join a LAN.');
      }
    }

    public function postParticipate($id,Request $request){
      if(Auth::check()){
        $lan=Lan::findOrFail($id);
        $user=Auth::user();
        $lan_user_player=DB::table('lan_user')->where('lan_id','=',$lan->id)->where('user_id','=',$user->id)->where('rank_lan','=',config('ranks.PLAYER'))->first();
        if($lan_user_player==null){
          $place_taken=DB::table('lan_user')->where('lan_id','=',$id)->where('place_number','=',$request->place_number)->select('id')->get();
          if(count($place_taken)==0){
            $lan->users()->attach($user,['rank_lan'=>config('ranks.PLAYER'),'score_lan'=>'0','place_number'=>$request->place_number]);
            return response()->json(['success'=>'You have been successfully registered to this LAN.']);
          }else{
            return response()->json(['error'=>'This place has already been taken, please choose another one.']);
          }
        }else{
          return response()->json(['error'=>'You are already participating to this LAN.']);
        }
      }else{
        return response()->json(['error'=>'Please login to perform this action.']);
      }
    }

    public function removePlayer($id){
      if(Auth::check()){
        $lan=Lan::findOrFail($id);
        $user=Auth::user();
        DB::table('lan_user')->where('lan_id','=',$lan->id)->where('user_id','=',$user->id)->where('rank_lan','=',config('ranks.PLAYER'))->delete();
        return response()->json(['success'=>'You are no longer registered to this LAN.']);
      }else{
        return response()->json(['error'=>'Please login to perform this action.']);
      }
    }

    public function addHelper($id){
      if(Auth::check()){
        $lan=Auth::user()->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
        if($lan==null){
          return back()->with('error','You have to be an admin of this LAN to add helpers to it.');
        }else{
          return view('lan.add_helper',compact('lan'));
        }
      }else{
        return redirect('/login')->with('error','Please login to perform this action.');
      }
    }

    public function postAddHelper($id,Request $request){
      if(Auth::check()){
        $lan=Auth::user()->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
        if($lan!=null){
          $user=User::where('id','=',$request->id_user)->select('id','pseudo')->first();
          if($user!=null){
            $lan_user_helper=$lan->users()->where('lan_user.user_id','=',$user->id)->where('lan_user.rank_lan','=',config('ranks.HELPER'))->first();
            if($lan_user_helper==null){
              $lan->users()->attach($user,['rank_lan'=>config('ranks.HELPER'),'score_lan'=>'0','place_number'=>'0']);
              return response()->json(['success'=>'The user "'.$user->pseudo.'" is now helper on this LAN.']);
            }else{
              return response()->json(['error'=>'The user "'.$user->pseudo.'" is already helper on this LAN.']);
            }
          }else{
            return response()->json(['error'=>'This user doesn\'t exist.']);
          }
        }else{
          return response()->json(['error'=>'You have to be an admin of this LAN to add helpers to it.']);
        }
      }else{
        return response()->json(['error'=>'Please login to perform this action.']);
      }
    }

    public function removeHelper($id,Request $request){
      if(Auth::check()){
        $lan=Auth::user()->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
        if($lan!=null){
          $user=User::where('users.id','=',$request->id_user)->join('lan_user','lan_user.user_id','=','users.id')->where('lan_user.lan_id','=',$lan->id)->where('lan_user.rank_lan','=',config('ranks.HELPER'))->select('users.id','pseudo')->first();
          if($user!=null){
            DB::table('lan_user')->where('lan_id','=',$lan->id)->where('user_id','=',$user->id)->where('rank_lan','=',config('ranks.HELPER'))->delete();
            return response()->json(['success'=>'The user "'.$user->pseudo.'" is no longer helper on this LAN.']);
          }else{
            return response()->json(['error'=>'This user doesn\'t exist or isn\'t helper on this lan.']);
          }
        }else{
          return response()->json(['error'=>'You have to be an admin of this LAN to remove helpers from it.']);
        }
      }else{
        return response()->json(['error'=>'Please login to perform this action.']);
      }
    }

    public function addAdmin($id){
      if(Auth::check()){
        $lan=Auth::user()->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
        if($lan==null){
          return back()->with('error','You have to be an admin of this LAN to add helpers to it.');
        }else{
          return view('lan.add_admin',compact('lan'));
        }
      }else{
        return redirect('/login')->with('error','Please login to perform this action.');
      }
    }

    public function postAddAdmin($id,Request $request){
      if(Auth::check()){
        $lan=Auth::user()->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
        if($lan!=null){
          $user=User::where('id','=',$request->id_user)->select('id','pseudo')->first();
          if($user!=null){
            $lan_user_admin=$lan->users()->where('lan_user.user_id','=',$user->id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first();
            if($lan_user_admin==null){
              $lan->users()->attach($user,['rank_lan'=>config('ranks.ADMIN'),'score_lan'=>'0','place_number'=>'0']);
              return response()->json(['success'=>'The user "'.$user->pseudo.'" is now admin on this LAN.']);
            }else{
              return response()->json(['error'=>'The user "'.$user->pseudo.'" is already admin on this LAN.']);
            }
          }else{
            return response()->json(['error'=>'This user doesn\'t exist.']);
          }
        }else{
          return response()->json(['error'=>'You have to be an admin of this LAN to add admins to it.']);
        }
      }else{
        return response()->json(['error'=>'Please login to perform this action.']);
      }
    }

    public function removeAdmin($id,Request $request){
      if(Auth::check()){
        $lan=Auth::user()->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
        if($lan!=null){
          $user=User::where('users.id','=',$request->id_user)->join('lan_user','lan_user.user_id','=','users.id')->where('lan_user.lan_id','=',$lan->id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->select('users.id','pseudo')->first();
          if($user!=null){
            if(count($lan->users()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->get())>1){
              DB::table('lan_user')->where('lan_id','=',$lan->id)->where('user_id','=',$user->id)->where('rank_lan','=',config('ranks.ADMIN'))->delete();
              return response()->json(['success'=>'The user "'.$user->pseudo.'" is no longer admin on this LAN.']);
            }else{
              return response()->json(['error'=>'You are the last admin on this LAN, please add at least an other admin before removing yourself from this LAN\'s admin list.']);
            }
          }else{
            return response()->json(['error'=>'This user doesn\'t exist or isn\'t admin on this lan.']);
          }
        }else{
          return response()->json(['error'=>'You have to be an admin of this LAN to remove admins from it.']);
        }
      }else{
        return response()->json(['error'=>'Please login to perform this action.']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if(Auth::check()){
        $lan=Lan::find($id);
        if($lan!=null){
          $user=User::where('users.id','=',Auth::id())->join('lan_user','lan_user.user_id','=','users.id')->where('lan_id','=',$id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->get();
          if($user!=null){
            $lan->delete();
            return response()->json(['success'=>'Your LAN has been successfully deleted.']);
          }else{
            return response()->json(['error'=>'You are not admin on this LAN.']);
          }
        }else{
          return response()->json(['error'=>'This LAN doesn\'t exist.']);
        }
      }else{
        return response()->json(['error'=>'Please log in to perform this action.']);
      }

    }
}
