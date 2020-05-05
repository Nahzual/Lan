<?php

namespace App\Http\Controllers;

use App\Lan;
use App\Location;
use App\City;
use App\Street;
use App\Department;
use App\Country;
use App\User;
use App\Game;
use App\Material;
use App\Tournament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

			return view('lan.index',compact('user','admin_lans','helper_lans','player_lans'));
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
     			$country->name_country = htmlentities($request->name_country);
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
     			$department->name_department = htmlentities($request->name_department);
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
     			$city->name_city = htmlentities($request->name_city);
     			$city->zip_city = htmlentities($request->zip_city);
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
     			$street->name_street = htmlentities($request->name_street);
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
     			$location->num_street = htmlentities($request->num_location);
     			$location->street()->associate($street);
     			$location->save();
     			//$location = Location::findOrFail($location->id);
     		}

     		$lan = new Lan();
     		$lan->name = htmlentities($request->name);
     		$lan->max_num_registrants = htmlentities($request->max_num_registrants);
     		$lan->opening_date = htmlentities($request->opening_date);
     		$lan->duration = htmlentities($request->duration);
     		$lan->budget = htmlentities($request->budget);
				$lan->room_width = htmlentities($request->room_width);
				$lan->room_length = htmlentities($request->room_length);
     		$lan->location()->associate($location);
     		$lan->save();

				// directory for lan's room plan
				$dir_name="../storage/lans";
				if(!file_exists($dir_name)){
					mkdir($dir_name,0777,true);
				}

				// json file for lan's room plan
				$file_name="../storage/lans/room_plan_".$lan->id.".json";
				if(!file_exists($file_name)){
					if(isset($request->room)){
						file_put_contents($file_name,$request->room);

						$lan->users()->attach(Auth::user()->id, ['rank_lan' => config('ranks.ADMIN'), 'score_lan' => 0, 'place_number' => 0]);

						return response()->json([
								'success'=>'Your LAN has been saved successfully.'
						]);
					}else{
						return response()->json([
								'error'=>'Please provide a room plan to create your LAN.'
						]);
					}
				}else{
					$lan->delete();
					return response()->json([
							'error'=>'Your LAN couldn\'t be created because of a file name conflict on the server, please contact an administrator if this problem persists.'
					]);
				}
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
				$games=$lan->games;
				$activities = $lan->activities;
				$tournaments = $lan->tournaments;
				if(Auth::check()){
					$user=Auth::user();
					$userIsLanAdmin=$user->lans()->where('lans.id','=',$lan->id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;
					if($userIsLanAdmin){
						$helpers=$lan->users()->where('lan_user.rank_lan','=',config('ranks.HELPER'))->get();
						$admins=$lan->users()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->get();
						$materials=$lan->materials()->select('materials.*','quantity')->get();
						return view('lan.show', compact('lan', 'location', 'street', 'city', 'department', 'country', 'helpers', 'admins', 'games', 'materials', 'activities','tournaments','userIsLanAdmin'))->with(['userIsLanAdminOrHelper'=>true]);
					}else{
						$userIsLanHelper=$user->lans()->where('lans.id','=',$lan->id)->where('lan_user.rank_lan','=',config('ranks.HELPER'))->first()!=null;
						if($userIsLanHelper){
							$materials=$lan->materials()->select('materials.*','quantity')->get();
							return view('lan.show', compact('lan', 'location', 'street', 'city', 'department', 'country', 'games', 'materials', 'activities','tournaments','userIsLanAdmin'))->with(['userIsLanAdminOrHelper'=>true]);
						}else{
							return view('lan.show', compact('lan', 'location', 'street', 'city', 'department', 'country', 'games', 'activities','tournaments'))->with(['userIsLanAdmin'=>false,'userIsLanAdminOrHelper'=>false]);
						}
					}
				}else{
					return view('lan.show', compact('lan', 'location', 'street', 'city', 'department', 'country', 'games', 'activities'))->with(['userIsLanAdmin'=>false,'userIsLanAdminOrHelper'=>false]);
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
					$room = file_get_contents('../storage/lans/room_plan_'.$id.'.json');
  				return view('lan.edit', compact('lan', 'location', 'street', 'city', 'department', 'country','room'));
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

					// handle room width and height requirements
					if(isset($request->room_width) && $request->room_width<=0){
						return response()->json(['error','Your room width has to be positive.']);
					}else if(isset($request->room_length) && $request->room_length<=0){
						return response()->json(['error','Your room length has to be positive.']);
					}else{
						// sets the room_length and room_width values
						$prev_room_width=$lan->room_width;
						$prev_room_length=$lan->room_length;
						if(isset($request->room_length)) $lan->room_length=$request->room_length;
						if(isset($request->room_width)) $lan->room_width=$request->room_width;

						// if room_length or room_width is smaller than its previous values, then there are places that are unreachable (out of the plan)
						// so let's delete all user participations that are bound to unreachable places
						if($lan->room_length<$prev_room_length || $lan->room_width<$prev_room_width){
							$room_json=json_decode($request->room_with_places);
							$main_room_json=json_decode($request->room);

							for($i=1 ; $i<count($room_json->places) ; ++$i){
								if($room_json->places[$i][0]>$lan->room_length || $room_json->places[$i][1]>$lan->room_width){
									$user_to_remove=DB::table('lan_user')->where('lan_user.lan_id','=',$lan->id)->where('lan_user.place_number','=',$i)->join('users','users.id','=','lan_user.user_id')->select('email')->first();
									DB::table('lan_user')->where('lan_user.lan_id','=',$lan->id)->where('lan_user.place_number','=',$i)->delete();
									if($user_to_remove!=null){
										Mail::send('mails.notification_player_removed', ['lan' => $lan], function ($message) use ($user_to_remove) {
											$message->from('lancreator.noreply@gmail.com','LAN Creator')
												->to($user_to_remove->email)
												->subject('You are no longer registered to a LAN');
										});
									}

									// reset place to empty place
									$main_room_json->room->field[$room_json->places[$i][0]][$room_json->places[$i][1]]=3;
								}
							}

							// replace main room's field with the one on which we replaced taken places by empty places
							$request->room=json_encode($main_room_json);
						}
					}

					// save lan's previous state
					$prev_state=$lan->waiting_lan;
  				$lan->update($request->all());

					// get all location relative information
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

          // Edit LAN's country if needed (might create an entry in the countries table)
          if(isset($request->name_country) && $request->name_country!=$country->name_country){

            $countries = Country::where('name_country','=',$request->name_country)->get();
            if($countries != null){$country = $countries->first();}
            if(!isset($country)){
              $country = new Country();
              $country->name_country = htmlentities($request->name_country);
              $country->save();
            }
          }

      		// Edit LAN's department if needed (might create an entry in the departments table)
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
      			$department->name_department = htmlentities($request->name_department);
      			$department->country()->associate($country);
      			$department->save();
      		}

      		// Edit LAN's city if needed (might create an entry in the cities table)
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
      			$city->name_city = htmlentities($request->name_city);
      			$city->zip_city = htmlentities($request->zip_city);
      			$city->department()->associate($department);
      			$city->save();
      		}

      		// Edit LAN's street if needed (might create an entry in the streets table)
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
      			$street->name_street = htmlentities($request->name_street);
      			$street->city()->associate($city);
      			$street->save();
      		}

					// Edit LAN's location if needed (might create an entry in the locations table)
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
      			$location->num_street = htmlentities($request->num_street);
      			$location->street()->associate($street);
      			$location->save();
      		}

          if($location!=$lan_location) $lan->location()->associate($location);
  				$lan->save();

					// updates the json file containing the LAN's room plan
					$file_name="../storage/lans/room_plan_".$lan->id.".json";
					if(file_exists($file_name) && isset($request->room)){
						file_put_contents($file_name, $request->room);
					}

					// if the LAN's state has changed, send an email to all of its admins to notify them
					if(isset($request->waiting_lan) && $lan->waiting_lan!=$prev_state){
						$admins=$lan->users()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->get();
						if($lan->waiting_lan==config('waiting.ACCEPTED')){
							foreach($admins as $admin){
								Mail::send('mails.notification_lan_accepted', ['lan' => $lan], function ($message) use ($admin) {
									$message->from('lancreator.noreply@gmail.com','LAN Creator')
										->to($admin->email)
										->subject('LAN accepted');
								});
							}
						}else if($lan->waiting_lan==config('waiting.REJECTED')){
							foreach($admins as $admin){
								Mail::send('mails.notification_lan_rejected', ['lan' => $lan], function ($message) use ($admin) {
									$message->from('lancreator.noreply@gmail.com','LAN Creator')
										->to($admin->email)
										->subject('LAN rejected');
								});
							}
						}
					}

  				return response()->json(['success'=>'Your LAN has been successfully edited.']);
  			}
  		}else{
        return response()->json(['error'=>'Please login to perform this action.']);
  		}
    }

		public function submit($id){
			if(Auth::check()){
				$lan=Lan::find($id);
				if($lan!=null){
					$lan_user=Auth::user()->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
					if($lan_user!=null){
						if($lan->waiting_lan==config('waiting.REJECTED')){
							$lan->waiting_lan=config('waiting.WAITING');
							$lan->save();
							return response()->json(['success'=>'You LAN has been successfully submitted.']);
						}else{
							return response()->json(['error'=>'You LAN is already submitted or has been accepted.']);
						}
					}else{
						return response()->json(['error'=>'You must be an admin of this LAN to do this.']);
					}
				}else{
					return response()->json(['error'=>'This LAN doesn\'t exist.']);
				}
			}else{
				return response()->json(['error'=>'Please login to perform this action.']);
			}
		}

    public function participate($id){
      if(Auth::check()){
        $lan=Lan::find($id);
        if($lan!=null){
          if($lan->waiting_lan==config('waiting.ACCEPTED')){
						$room=file_get_contents("../storage/lans/room_plan_".$lan->id.".json");
            return view('lan.participate',compact('lan','room'));
          }else{
            return redirect('/home')->with('error','You can\'t join this LAN because it isn\'t accepted yet.');
          }
        }else{
          return redirect('/home')->with('error','This LAN doesn\'t exist.');
        }

      }else{
        return redirect('/login')->with('error','You must be logged in to join a LAN.');
      }
    }

    public function postParticipate($id,Request $request){
      if(Auth::check()){
        $lan=Lan::find($id);
        if($lan!=null){
          if($lan->waiting_lan==config('waiting.ACCEPTED')){
            $user=Auth::user();
            $lan_user_player=DB::table('lan_user')->where('lan_id','=',$lan->id)->where('user_id','=',$user->id)->where('rank_lan','=',config('ranks.PLAYER'))->first();
            if($lan_user_player==null){
              $place_taken=DB::table('lan_user')->where('lan_id','=',$id)->where('place_number','=',$request->place_number)->select('id')->get();
              if(count($place_taken)==0){

								// update json file
								if(isset($request->new_room)){
									$file_name="../storage/lans/room_plan_".$id.".json";
									file_put_contents($file_name,$request->new_room);
								}


                $lan->users()->attach($user,['rank_lan'=>config('ranks.PLAYER'),'score_lan'=>'0','place_number'=>$request->place_number]);
                return response()->json(['success'=>'You have been successfully registered to this LAN.']);
              }else{
                return response()->json(['error'=>'This place has already been taken, please choose another one.']);
              }
            }else{
              return response()->json(['error'=>'You are already participating to this LAN.']);
            }
          }else{
            return response()->json(['error'=>'You can\'t join this LAN because it isn\'t accepted yet.']);
          }
        }else{
          return response()->json(['error'=>'This LAN doesn\'t exist.']);
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
				$admin=Auth::user();
				$lan=$admin->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
        if($lan!=null){
          $user=User::where('id','=',$request->id_user)->select('id','pseudo','email')->first();
          if($user!=null){
            $lan_user_helper=$lan->users()->where('lan_user.user_id','=',$user->id)->where('lan_user.rank_lan','=',config('ranks.HELPER'))->first();
            if($lan_user_helper==null){

							// send a mail to notify the user that he has been added as an helper on this LAN
							Mail::send('mails.notification_helper_added', ['lan' => $lan,'admin' => $admin], function ($message) use ($user) {
								$message->from('lancreator.noreply@gmail.com','LAN Creator')
									->to($user->email)
									->subject('You have been added as helper on a LAN');
							});

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
				$admin=Auth::user();
        $lan=$admin->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
        if($lan!=null){
          $user=User::where('users.id','=',$request->id_user)->join('lan_user','lan_user.user_id','=','users.id')->where('lan_user.lan_id','=',$lan->id)->where('lan_user.rank_lan','=',config('ranks.HELPER'))->select('users.id','pseudo','email')->first();
          if($user!=null){

						// send a mail to notify the user that he has been removed from the helper list
						Mail::send('mails.notification_helper_removed', ['lan' => $lan,'admin' => $admin], function ($message) use ($user) {
							$message->from('lancreator.noreply@gmail.com','LAN Creator')
								->to($user->email)
								->subject('You have been removed from the helper list of a LAN');
						});

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
          return back()->with('error','You have to be an admin of this LAN to add admins to it.');
        }else{
          return view('lan.add_admin',compact('lan'));
        }
      }else{
        return redirect('/login')->with('error','Please login to perform this action.');
      }
    }

    public function postAddAdmin($id,Request $request){
      if(Auth::check()){
				$admin=Auth::user();
				$lan=$admin->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
        if($lan!=null){
          $user=User::where('id','=',$request->id_user)->select('id','pseudo','email')->first();
          if($user!=null){
            $lan_user_admin=$lan->users()->where('lan_user.user_id','=',$user->id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first();
            if($lan_user_admin==null){
							// send a mail to notify the user that he has been added as an helper on this LAN
							Mail::send('mails.notification_admin_added', ['lan' => $lan,'admin' => $admin], function ($message) use ($user) {
								$message->from('lancreator.noreply@gmail.com','LAN Creator')
									->to($user->email)
									->subject('You have been added as admin on a LAN');
							});

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

    public function addGame($id){
      if(Auth::check()){
        $lan=Auth::user()->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
        if($lan==null){
          return back()->with('error','You have to be an admin of this LAN to add games to it.');
        }else{
          return view('lan.add_game',compact('lan'));
        }
      }else{
        return redirect('/login')->with('error','Please login to perform this action.');
      }
    }

    public function postAddGame($id,Request $request){
      if(Auth::check()){
        $lan=Auth::user()->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
        if($lan!=null){
          $game=Game::where('games.id','=',$request->game_id)->select('games.id','games.name_game')->first();
          if($game!=null){
            $lan_game=$lan->games()->where('can_play.id_game','=',$game->id)->first();
            if($lan_game==null){
              $lan->games()->attach($game);
              return response()->json(['success'=>'The game "'.$game->name_game.'" has been added to this LAN\'s game list.']);
            }else{
              return response()->json(['error'=>'The game "'.$game->name_game.'" is already in this LAN\'s game list.']);
            }
          }else{
            return response()->json(['error'=>'This game doesn\'t exist.']);
          }
        }else{
          return response()->json(['error'=>'You have to be an admin of this LAN to add games to it.']);
        }
      }else{
        return response()->json(['error'=>'Please login to perform this action.']);
      }
    }

    public function removeGame($id,Request $request){
      if(Auth::check()){
        $lan=Auth::user()->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
        if($lan!=null){
          $game=Game::where('games.id','=',$request->game_id)->join('can_play','can_play.id_game','=','games.id')->where('can_play.id_lan','=',$lan->id)->select('games.id','games.name_game')->first();
          if($game!=null){
            DB::table('can_play')->where('id_lan','=',$lan->id)->where('id_game','=',$game->id)->delete();
            return response()->json(['success'=>'The game "'.$game->name_game.'" is no longer in this lan\'s game list.']);
          }else{
            return response()->json(['error'=>'This game doesn\'t exist or isn\'t in this lan\'s game list.']);
          }
        }else{
          return response()->json(['error'=>'You have to be an admin of this LAN to remove games from it.']);
        }
      }else{
        return response()->json(['error'=>'Please login to perform this action.']);
      }
    }


	public function addMaterial($id){
		if(Auth::check()){
			$lan=Auth::user()->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($id);

			if($lan==null){
				return back()->with('error','You have to be an admin or helper of this LAN to add materials to it.');
			}else{
				return view('lan.add_material',compact('lan'));
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}

	public function postAddMaterial($id,Request $request){
		if(Auth::check()){
			$lan=Auth::user()->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($id);

			if($lan!=null){
				$material=Material::where('materials.id','=',$request->material_id)->select('materials.id','materials.name_material')->first();
				if($material!=null){
					$lan_material=$lan->materials()->where('needs.id_material','=',$material->id)->select('materials.*','needs.id as id_needs','quantity')->first();
					if($lan_material==null){
						if(is_numeric($request->quantity) && $request->quantity>0){
							$lan->materials()->attach($material,['quantity'=>$request->quantity]);
							return response()->json(['success'=>'The material "'.$material->name_material.'" has been added to this LAN\'s material list.']);
						}else{
							return response()->json(['error'=>'The quantity must be a positive number.']);
						}
					}else{
						if(is_numeric($request->quantity) && $request->quantity>0){
							DB::table('needs')->where('id','=',$lan_material->id_needs)->update(['quantity'=>$lan_material->quantity+$request->quantity]);
							return response()->json(['success'=>$request->quantity.' "'.$material->name_material.'" have been added to this LAN\'s material list.']);
						}else{
							return response()->json(['error'=>'The quantity must be a positive number.']);
						}
					}
				}else{
					return response()->json(['error'=>'This material doesn\'t exist.']);
				}
			}else{
				return response()->json(['error'=>'You have to be an admin or helper of this LAN to add materials to it.']);
			}
		}else{
			return response()->json(['error'=>'Please login to perform this action.']);
		}
	}

	public function editQuantity($id,Request $request){
		if(Auth::check()){
			$lan=Auth::user()->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($id);

			if($lan!=null){
				$material=Material::where('materials.id','=',$request->material_id)->select('materials.id','materials.name_material')->first();
				if($material!=null){
					$lan_material=$lan->materials()->where('needs.id_material','=',$material->id)->select('materials.*','needs.id as id_needs','quantity');
					if($lan_material->first()!=null){
						if(is_numeric($request->quantity) && $request->quantity>0){
							$lan_material->update(['quantity'=>$request->quantity]);
							return response()->json(['success'=>'This material\'s quantity has been set to '.htmlentities($request->quantity).'.']);
						}else{
							return response()->json(['error'=>'The quantity must be a positive number.']);
						}
					}else{
						return response()->json(['error'=>'This material isn\'t in this LAN\'s material list.']);
					}
				}else{
					return response()->json(['error'=>'This material doesn\'t exist.']);
				}
			}else{
				return response()->json(['error'=>'You have to be an admin or helper of this LAN to edit its material list.']);
			}
		}else{
			return response()->json(['error'=>'Please login to perform this action.']);
		}
	}

	public function removeMaterial($id,Request $request){
		if(Auth::check()){
			$lan=Auth::user()->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($id);
			if($lan!=null){
				$material=Material::where('materials.id','=',$request->material_id)->join('needs','needs.id_material','=','materials.id')->where('needs.id_lan','=',$lan->id)->select('materials.id','materials.name_material')->first();
				if($material!=null){
					DB::table('needs')->where('id_lan','=',$lan->id)->where('id_material','=',$material->id)->delete();
					return response()->json(['success'=>'The material "'.$material->name_material.'" is no longer in this lan\'s material list.']);
				}else{
					return response()->json(['error'=>'This material doesn\'t exist or isn\'t in this lan\'s material list.']);
				}
			}else{
				return response()->json(['error'=>'You have to be an admin or helper of this LAN to remove materials from it.']);
			}
		}else{
			return response()->json(['error'=>'Please login to perform this action.']);
		}
	}


	public function addShopping($id){
		if(Auth::check()){
			$lan=Auth::user()->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($id);
			if($lan==null){
				return back()->with('error','You have to be an admin of this LAN to add shoppings to it.');
			}else{
				return view('lan.add_shopping',compact('lan'));
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}

	public function postAddShopping($id,Request $request){
		if(Auth::check()){
			$lan=Auth::user()->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($id);
			if($lan!=null){
				$shopping=Shopping::where('shoppings.id','=',$request->shopping_id)->select('shoppings.id','shoppings.name_shopping')->first();
				if($shopping!=null){
					$lan_shopping=$lan->shoppings()->where('needs.id_shopping','=',$shopping->id)->first();
					if($lan_shopping==null){
						$lan->shoppings()->attach($shopping);
						return response()->json(['success'=>'The shopping "'.$shopping->name_shopping.'" has been added to this LAN\'s shopping list.']);
					}else{
						return response()->json(['error'=>'The shopping "'.$shopping->name_shopping.'" is already in this LAN\'s shopping list.']);
					}
				}else{
					return response()->json(['error'=>'This shopping doesn\'t exist.']);
				}
			}else{
				return response()->json(['error'=>'You have to be an admin of this LAN to add shoppings to it.']);
			}
		}else{
			return response()->json(['error'=>'Please login to perform this action.']);
		}
	}

	public function removeShopping($id,Request $request){
		if(Auth::check()){
			$lan=Auth::user()->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($id);
			if($lan!=null){
				$shopping=Shopping::where('shoppings.id','=',$request->shopping_id)->join('needs','needs.id_shopping','=','shoppings.id')->where('needs.id_lan','=',$lan->id)->select('shoppings.id','shoppings.name_shopping')->first();
				if($shopping!=null){
					DB::table('needs')->where('id_lan','=',$lan->id)->where('id_shopping','=',$shopping->id)->delete();
					return response()->json(['success'=>'The shopping "'.$shopping->name_shopping.'" is no longer in this lan\'s shopping list.']);
				}else{
					return response()->json(['error'=>'This shopping doesn\'t exist or isn\'t in this lan\'s shopping list.']);
				}
			}else{
				return response()->json(['error'=>'You have to be an admin of this LAN to remove shoppings from it.']);
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

	 					// delete the json file of this LAN
	 					$file_name="../storage/lans/room_plan_".$lan->id.".json";
	 					if(file_exists($file_name)){
	 						unlink($file_name);
	 					}

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
    /**
     * List all the LANs
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function list_all(Request $request){
        $lans = Lan::where('waiting_lan','=',config('waiting.ACCEPTED'))->where('opening_date','>',date('Y-m-d'))->get();

        return view('lan.list_all', compact('lans'));
    }
}
