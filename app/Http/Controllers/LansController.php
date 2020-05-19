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

class LansController extends Controller{

	/**
	* Shows the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create(){
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

					$lan->users()->attach(Auth::user()->id, ['rank_lan' => config('ranks.ADMIN'), 'score_lan' => 0]);

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
	public function show($id){
		$lan = Lan::find($id);
		if($lan!=null){
			$location = $lan->location;
			$street = $location->street;
			$city = $street->city;
			$department = $city->department;
			$country = $department->country;
			$games=$lan->games->take(-5);
			$activities = $lan->activities->take(-5);
			$tournaments = $lan->tournaments->take(-5);
			if(Auth::check()){
				$user=Auth::user();
				$userIsLanAdmin=$user->lans()->where('lans.id','=',$lan->id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;
				if($userIsLanAdmin){
					$helpers=$lan->real_users()->where('lan_user.rank_lan','=',config('ranks.HELPER'))->get()->take(-5);
					$admins=$lan->real_users()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->get()->take(-5);
					$users=$lan->real_users()->where('lan_user.rank_lan','=',config('ranks.PLAYER'))->get()->take(-5);
					$materials=$lan->materials()->select('materials.*','quantity')->get()->take(-5);
					$tasks = $lan->tasks->take(-5);
					$shoppings = $lan->shoppings;
					$ports=$games->toBase();
					foreach($ports as $index=>$game){
						$ports[$index]=$game->ports()->where('uses_port.id_lan','=',$lan->id)->get();
					}
					$totalprice_shopping = $lan->price_shopping($shoppings);
					$shoppings = $shoppings->take(-5);
					return view('lan.show', compact('lan', 'location', 'street', 'city', 'department', 'country', 'helpers', 'admins', 'users', 'games', 'ports', 'materials', 'activities','tournaments','tasks','userIsLanAdmin', 'shoppings', 'totalprice_shopping'))->with(['userIsLanAdminOrHelper'=>true]);
				}else{
					$userIsLanHelper=$user->lans()->where('lans.id','=',$lan->id)->where('lan_user.rank_lan','=',config('ranks.HELPER'))->first()!=null;
					if($userIsLanHelper){
						$materials=$lan->materials()->select('materials.*','quantity')->get()->take(-5);
						$shoppings = $lan->shoppings->take(-5);
						$tasks = $lan->tasks->take(-5);
						$users=$lan->users->take(-5);
						$totalprice_shopping = 0;
						foreach($shoppings as $shopping){
							$totalprice_shopping += $shopping->cost_shopping*$shopping->quantity_shopping;
						}
						return view('lan.show', compact('lan', 'location', 'street', 'city', 'tasks', 'users','department', 'country', 'games', 'materials', 'shoppings', 'activities','tournaments','userIsLanAdmin', 'totalprice_shopping'))->with(['userIsLanAdminOrHelper'=>true]);
					}else{
						return view('lan.show', compact('lan', 'location', 'street', 'city', 'department', 'country', 'games', 'activities','tournaments'))->with(['userIsLanAdmin'=>false,'userIsLanAdminOrHelper'=>false]);
					}
				}
			}else{
				return view('lan.show', compact('lan', 'location', 'street', 'city', 'department', 'country', 'games', 'activities'))->with(['userIsLanAdmin'=>false,'userIsLanAdminOrHelper'=>false]);
			}
		}else{
			return back()->with('error','This LAN does not exist.');
		}
	}

	/**
	* Display the specified LAN for users that are not admin nor helper.
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function guestShow($id){
		$lan = Lan::find($id);

		if($lan!=null){
			$location = $lan->location;
			$street = $location->street;
			$city = $street->city;
			$department = $city->department;
			$country = $department->country;
			$games=$lan->games->take(-5);
			$activities = $lan->activities->take(-5);
			$tournaments = $lan->tournaments->take(-5);

			if(Auth::check()){
				return view('lan.show_guest', compact('lan', 'location', 'street', 'city', 'department', 'country', 'games', 'activities','tournaments'));
			}else{
				return view('lan.show_guest_external', compact('lan', 'location', 'street', 'city', 'department', 'country', 'games', 'activities','tournaments'));
			}
		}else{
			return back()->with('error','This LAN does not exist.');
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
			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->select('lans.id')->find($id)==null && !$user->isSiteAdmin()){
				return back()->with('error','You can\'t edit a LAN for which you are not an admin.');
			}else{
				$lan = Lan::find($id);
				if($lan!=null){
					$location = $lan->location;
					$street = $location->street;
					$city = $street->city;
					$department = $city->department;
					$country = $department->country;
					$room = file_get_contents('../storage/lans/room_plan_'.$id.'.json');
					return view('lan.edit', compact('lan', 'location', 'street', 'city', 'department', 'country','room'));
				}else{
					return back()->with('error','This LAN does not exist.');
				}
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
	public function update(Request $request, $id){
		if(Auth::check()){
			$user=Auth::user();
			if($user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
				return response()->json(['error'=>'You have to be an admin of this LAN to edit it.']);
			}else{
				$lan = Lan::find($id);
				if($lan!=null){
					// handle room width and height requirements
					if(isset($request->room_width) && $request->room_width<=0){
						return response()->json(['error'=>'Your room width has to be positive.']);
					}else if(isset($request->room_length) && $request->room_length<=0){
						return response()->json(['error'=>'Your room length has to be positive.']);
					}else if(isset($request->room_width) && isset($request->room_length)){
						// sets the room_length and room_width values
						if(isset($request->room_length)) $lan->room_length=$request->room_length;
						if(isset($request->room_width)) $lan->room_width=$request->room_width;

						if(isset($request->room_with_places) && isset($request->room)){
							$room_json=json_decode($request->room_with_places);
							$main_room_json=json_decode($request->room);

							for($i=1 ; $i<count($room_json->places) ; ++$i){
								//  if there are places where x > room_length or y > room_width, or if there are places that are now bound to something else than a taken chair, then there are places that are deleted
								// so we have to delete all user participations that are bound to deleted places
								if($room_json->places[$i][0]>$lan->room_length || $room_json->places[$i][1]>$lan->room_width || $room_json->room->field[$room_json->places[$i][0]][$room_json->places[$i][1]]!=config('room.TAKEN_CHAIR')){
									$user_to_remove=DB::table('lan_user')->where('lan_user.lan_id','=',$lan->id)->where('lan_user.place_number_x','=',$room_json->places[$i][1])->where('lan_user.place_number_y','=',$room_json->places[$i][0])->join('users','users.id','=','lan_user.user_id')->select('email')->first();
									DB::table('lan_user')->where('lan_user.lan_id','=',$lan->id)->where('lan_user.place_number_x','=',$room_json->places[$i][1])->where('lan_user.place_number_y','=',$room_json->places[$i][0])->delete();

									if($user_to_remove!=null){
										try{
											Mail::send('mails.notification_player_removed', ['lan' => $lan], function ($message) use ($user_to_remove) {
												$message->from('lancreator.noreply@gmail.com','LAN Creator')
												->to($user_to_remove->email)
												->subject('You are no longer registered to a LAN');
											});
										}catch(\Exception $e){

										}
									}

									// reset place to empty place if out of bounds
									if($room_json->places[$i][0]>$lan->room_length || $room_json->places[$i][1]>$lan->room_width){
										$main_room_json->room->field[$room_json->places[$i][0]][$room_json->places[$i][1]]=config('room.EMPTY_CHAIR');
									}
								}
							}

							// replace main room's field with the one on which we replaced taken places by empty places
							$request->room=json_encode($main_room_json);
						}
					}

					// save lan's previous state
					$prev_state=$lan->waiting_lan;

					// update LAN
					if(isset($request->max_num_registrants) && is_numeric($request->max_num_registrants) && $request->max_num_registrants>0){
						$lan->max_num_registrants=$request->max_num_registrants;
					}else if(isset($request->max_num_registrants)){
						return response()->json(['error'=>'The number of registrants has to be a positive number.']);
					}

					if(isset($request->opening_date)){
						$date=date_create($request->opening_date);

						if($date && $date->format('Y-m-d')===$request->opening_date){
							$lan->opening_date=$request->opening_date;
						}else{
							return response()->json(['error'=>'The opening date is not a valid date.']);
						}
					}

					if(isset($request->duration) && is_numeric($request->duration) && $request->duration>0){
						$lan->duration=$request->duration;
					}else if(isset($request->duration)){
						return response()->json(['error'=>'The duration has to be a positive number.']);
					}

					if(isset($request->budget) && is_numeric($request->budget) && $request->budget>=0){
						$lan->budget=$request->budget;
					}else if(isset($request->budget)){
						return response()->json(['error'=>'The budget has to be a positive number or zero.']);
					}

					if(isset($request->name)) $lan->name=htmlentities($request->name);

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
						if($countries != null) $country = $countries->first();
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
						if(strlen($request->zip_city)==5 && ctype_digit($request->zip_city)){
							$city->zip_city = htmlentities($request->zip_city);
						}else{
							return response()->json(['error'=>'The ZIP code must be a 5-digit number.']);
						}
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
						if(is_numeric($request->num_street) && $request->num_street>0){
							$location->num_street = htmlentities($request->num_street);
						}else{
							return response()->json(['error'=>'The street number has to be a positive number.']);
						}
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
								try{
									Mail::send('mails.notification_lan_accepted', ['lan' => $lan], function ($message) use ($admin) {
										$message->from('lancreator.noreply@gmail.com','LAN Creator')
										->to($admin->email)
										->subject('LAN accepted');
									});
								}catch(\Exception $e){

								}
							}
						}else if($lan->waiting_lan==config('waiting.REJECTED')){
							foreach($admins as $admin){
								try{
									Mail::send('mails.notification_lan_rejected', ['lan' => $lan], function ($message) use ($admin) {
										$message->from('lancreator.noreply@gmail.com','LAN Creator')
										->to($admin->email)
										->subject('LAN rejected');
									});
								}catch(\Exception $e){

								}
							}
						}
					}

					return response()->json(['success'=>'Your LAN has been successfully edited.']);
				}else{
					return response()->json(['error'=>'This LAN does not exist.']);
				}
			}
		}else{
			return response()->json(['error'=>'Please login to perform this action.']);
		}
	}

	/**
	* Submit a LAN that has been rejected
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function submit($id){
		if(Auth::check()){
			$lan=Lan::find($id);
			if($lan!=null){
				$user=Auth::user();
				$lan_user=$user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
				if($lan_user!=null || $user->isSiteAdmin()){
					if($lan->waiting_lan==config('waiting.REJECTED')){
						$lan->waiting_lan=config('waiting.WAITING');
						$lan->save();
						return response()->json(['success'=>'Your LAN has been successfully submitted.']);
					}else{
						return response()->json(['error'=>'Your LAN is already submitted or has been accepted.']);
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

	/**
	* Show the form to join a LAN as a player
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function participate($id){
		if(Auth::check()){
			$lan=Lan::find($id);
			if($lan!=null){
				if($lan->waiting_lan==config('waiting.ACCEPTED')){
					$diff=(new \DateTime())->diff(date_create($lan->opening_date));
					if($diff->invert==0 || $diff->days==0){
						$room=file_get_contents("../storage/lans/room_plan_".$lan->id.".json");
						return view('lan.participate',compact('lan','room'));
					}else{
						return back()->with('error','You can\'t join this LAN because it is already over.');
					}
				}else{
					return back()->with('error','You can\'t join this LAN because it isn\'t accepted yet.');
				}
			}else{
				return back()->with('error','This LAN doesn\'t exist.');
			}
		}else{
			return redirect('/login')->with('error','You must be logged in to join a LAN.');
		}
	}

	/**
	* Add the logged user to the player list of the specified LAN
	*
	* @param  int  $id
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function postParticipate($id,Request $request){
		if(Auth::check()){
			$lan=Lan::find($id);
			if($lan!=null){
				if($lan->waiting_lan==config('waiting.ACCEPTED')){
					$diff=(new \DateTime())->diff(date_create($lan->opening_date));
					if($diff->invert==0 || $diff->days==0){
						$user=Auth::user();
						$lan_user_player=DB::table('lan_user')->where('lan_id','=',$lan->id)->where('user_id','=',$user->id)->where('rank_lan','=',config('ranks.PLAYER'))->first();
						if($lan_user_player==null){
							$place_taken=DB::table('lan_user')->where('lan_id','=',$id)->where('place_number_x','=',$request->place_number_x)->where('place_number_y','=',$request->place_number_y)->select('lan_id')->get();
							if(count($place_taken)==0){
								// update json file
								if(isset($request->new_room)){
									$file_name="../storage/lans/room_plan_".$id.".json";
									file_put_contents($file_name,$request->new_room);
								}

								$lan->users()->attach($user,['rank_lan'=>config('ranks.PLAYER'),'score_lan'=>'0','place_number_x'=>$request->place_number_x,'place_number_y'=>$request->place_number_y]);
								return response()->json(['success'=>'You have been successfully registered to this LAN.']);
							}else{
								return response()->json(['error'=>'This place has already been taken, please choose another one.']);
							}
						}else{
							return response()->json(['error'=>'You are already participating to this LAN.']);
						}
					}else{
						return response()->json(['error'=>'You can\'t join this LAN because it is already over.']);
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

	/**
	* Remove the specified user from the player list of the specified LAN
	*
	* @param  int  $id
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function removePlayer($id,Request $request){
		if(Auth::check()){
			$lan=Lan::find($id);
			if($lan!=null){
				if(isset($request->player_id)){
					$user=Auth::user();
					if($user->id==$request->player_id || $user->isSiteAdmin()){
						$user=User::find($request->player_id);
						if($user!=null){
							$lan_user=DB::table('lan_user')->where('lan_id','=',$lan->id)->where('user_id','=',$user->id)->where('rank_lan','=',config('ranks.PLAYER'))->select('place_number_x','place_number_y')->first();
							if($lan_user!=null){
								$file_name="../storage/lans/room_plan_".$lan->id.".json";
								if(file_exists($file_name)){
									$room=json_decode(file_get_contents($file_name));
									$room->room->field[$lan_user->place_number_y][$lan_user->place_number_x]=config('room.EMPTY_CHAIR');
									file_put_contents($file_name, json_encode($room));
								}
								DB::table('lan_user')->where('lan_id','=',$lan->id)->where('user_id','=',$user->id)->where('rank_lan','=',config('ranks.PLAYER'))->delete();
								return response()->json(['success'=>'This user is no longer a player of this LAN.']);

							}else{
								return response()->json(['error'=>'This user isn\'t a player of this LAN.']);
							}
						}else{
							return response()->json(['error'=>'This user does not exist.']);
						}
					}else{
						return response()->json(['error'=>'You can\'t make an other player leave this LAN.']);
					}
				}else{
					$user=Auth::user();
					$lan_user=DB::table('lan_user')->where('lan_id','=',$lan->id)->where('user_id','=',$user->id)->where('rank_lan','=',config('ranks.PLAYER'))->select('place_number_x','place_number_y')->first();
					if($lan_user!=null){
						$file_name="../storage/lans/room_plan_".$lan->id.".json";
						if(file_exists($file_name)){
							$room=json_decode(file_get_contents($file_name));
							$room->room->field[$lan_user->place_number_y][$lan_user->place_number_x]=config('room.EMPTY_CHAIR');
							file_put_contents($file_name, json_encode($room));
						}
						DB::table('lan_user')->where('lan_id','=',$lan->id)->where('user_id','=',$user->id)->where('rank_lan','=',config('ranks.PLAYER'))->delete();
						return response()->json(['success'=>'You are no longer registered to this LAN.']);
					}else{
						return response()->json(['error'=>'You are not a player of this LAN.']);
					}
				}
			}else{
				return response()->json(['error'=>'This LAN does not exist.']);
			}
		}else{
			return response()->json(['error'=>'Please login to perform this action.']);
		}
	}

	/**
	* Show the form to add an helper to a LAN
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function addHelper($id){
		if(Auth::check()){
			$user=Auth::user();
			$lan=$user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
			if($lan==null && !$user->isSiteAdmin()){
				return back()->with('error','You have to be an admin of this LAN to add helpers to it.');
			}else{
				$lan=Lan::find($id);
				if($lan!=null){
					return view('lan.add_helper',compact('lan'));
				}else{
					return back()->with('error','This LAN does not exist.');
				}
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}

	/**
	* Add the specified user to the helper list of the specified LAN
	*
	* @param  int  $id
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function postAddHelper($id,Request $request){
		if(Auth::check()){
			$admin=Auth::user();
			$lan=$admin->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
			if($lan!=null || $admin->isSiteAdmin()){
				$lan=Lan::find($id);
				if($lan!=null){
					$user=User::where('id','=',$request->id_user)->select('id','pseudo','email')->first();
					if($user!=null){
						$lan_user_helper=$lan->users()->where('lan_user.user_id','=',$user->id)->where('lan_user.rank_lan','=',config('ranks.HELPER'))->first();
						if($lan_user_helper==null){

							try{
								// send a mail to notify the user that he has been added as an helper on this LAN
								Mail::send('mails.notification_helper_added', ['lan' => $lan,'admin' => $admin], function ($message) use ($user) {
									$message->from('lancreator.noreply@gmail.com','LAN Creator')
									->to($user->email)
									->subject('You have been added as helper on a LAN');
								});
							}catch(\Exception $e){

							}

							$lan->users()->attach($user,['rank_lan'=>config('ranks.HELPER'),'score_lan'=>'0']);
							return response()->json(['success'=>'The user "'.$user->pseudo.'" is now helper on this LAN.']);
						}else{
							return response()->json(['error'=>'The user "'.$user->pseudo.'" is already helper on this LAN.']);
						}
					}else{
						return response()->json(['error'=>'This user doesn\'t exist.']);
					}
				}else{
					return response()->json(['error'=>'This LAN does not exist.']);
				}
			}else{
				return response()->json(['error'=>'You have to be an admin of this LAN to add helpers to it.']);
			}
		}else{
			return response()->json(['error'=>'Please login to perform this action.']);
		}
	}

	/**
	* Remove the specified user from the helper list of the specified LAN
	*
	* @param  int  $id
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function removeHelper($id,Request $request){
		if(Auth::check()){
			$admin=Auth::user();
			$lan=$admin->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
			if($lan!=null || $admin->isSiteAdmin()){
				$lan=Lan::find($id);
				if($lan!=null){
					$user=User::where('users.id','=',$request->id_user)->join('lan_user','lan_user.user_id','=','users.id')->where('lan_user.lan_id','=',$lan->id)->where('lan_user.rank_lan','=',config('ranks.HELPER'))->select('users.id','pseudo','email')->first();
					if($user!=null){

						try{
							// send a mail to notify the user that he has been removed from the helper list
							Mail::send('mails.notification_helper_removed', ['lan' => $lan,'admin' => $admin], function ($message) use ($user) {
								$message->from('lancreator.noreply@gmail.com','LAN Creator')
								->to($user->email)
								->subject('You have been removed from the helper list of a LAN');
							});
						}catch(\Exception $e){

						}


						DB::table('lan_user')->where('lan_id','=',$lan->id)->where('user_id','=',$user->id)->where('rank_lan','=',config('ranks.HELPER'))->delete();
						return response()->json(['success'=>'The user "'.$user->pseudo.'" is no longer helper on this LAN.']);
					}else{
						return response()->json(['error'=>'This user doesn\'t exist or isn\'t helper on this lan.']);
					}
				}else{
					return response()->json(['error'=>'This LAN does not exist.']);
				}
			}else{
				return response()->json(['error'=>'You have to be an admin of this LAN to remove helpers from it.']);
			}
		}else{
			return response()->json(['error'=>'Please login to perform this action.']);
		}
	}

	/**
	* Show the form to add an admin to a LAN
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function addAdmin($id){
		if(Auth::check()){
			$user=Auth::user();
			$lan=$user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
			if($lan==null && !$user->isSiteAdmin()){
				return back()->with('error','You have to be an admin of this LAN to add admins to it.');
			}else{
				$lan=Lan::find($id);
				if($lan!=null){
					return view('lan.add_admin',compact('lan'));
				}else{
					return back()->with('error','This LAN does not exist.');
				}
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}

	/**
	* Add the specified user to the admin list of the specified LAN
	*
	* @param  int  $id
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function postAddAdmin($id,Request $request){
		if(Auth::check()){
			$admin=Auth::user();
			$lan=$admin->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
			if($lan!=null || $admin->isSiteAdmin()){
				$lan=Lan::find($id);
				if($lan!=null){

					$user=User::where('id','=',$request->id_user)->select('id','pseudo','email')->first();
					if($user!=null){
						$lan_user_admin=$lan->users()->where('lan_user.user_id','=',$user->id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first();
						if($lan_user_admin==null){

							try{
								// send a mail to notify the user that he has been added as an helper on this LAN
								Mail::send('mails.notification_admin_added', ['lan' => $lan,'admin' => $admin], function ($message) use ($user) {
									$message->from('lancreator.noreply@gmail.com','LAN Creator')
									->to($user->email)
									->subject('You have been added as admin on a LAN');
								});
							}catch(\Exception $e){

							}


							$lan->users()->attach($user,['rank_lan'=>config('ranks.ADMIN'),'score_lan'=>'0']);
							return response()->json(['success'=>'The user "'.$user->pseudo.'" is now admin on this LAN.']);
						}else{
							return response()->json(['error'=>'The user "'.$user->pseudo.'" is already admin on this LAN.']);
						}
					}else{
						return response()->json(['error'=>'This user doesn\'t exist.']);
					}
				}else{
					return response()->json(['error'=>'This LAN does not exist.']);
				}
			}else{
				return response()->json(['error'=>'You have to be an admin of this LAN to add admins to it.']);
			}
		}else{
			return response()->json(['error'=>'Please login to perform this action.']);
		}
	}

	/**
	* Remove the specified user from the admin list of the specified LAN
	*
	* @param  int  $id
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function removeAdmin($id,Request $request){
		if(Auth::check()){
			$logged_user=Auth::user();
			$lan=$logged_user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
			if($lan!=null || $logged_user->isSiteAdmin()){
				$lan=Lan::find($id);
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
					return response()->json(['error'=>'This LAN does not exist.']);
				}
			}else{
				return response()->json(['error'=>'You have to be an admin of this LAN to remove admins from it.']);
			}
		}else{
			return response()->json(['error'=>'Please login to perform this action.']);
		}
	}

	/**
	* Show the form to add a game to a LAN
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function addGame($id){
		if(Auth::check()){
			$user=Auth::user();
			$lan=$user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
			if($lan==null && !$user->isSiteAdmin()){
				return back()->with('error','You have to be an admin of this LAN to add games to it.');
			}else{
				$lan=Lan::find($id);
				if($lan!=null){
					return view('lan.add_game',compact('lan'));
				}else{
					return back()->with('error','This LAN does not exist.');
				}
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}

	/**
	* Add the specified game to the specified LAN
	*
	* @param  int  $id
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function postAddGame($id,Request $request){
		if(Auth::check()){
			$user=Auth::user();
			$lan=$user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
			if($lan!=null || $user->isSiteAdmin()){
				$lan=Lan::find($id);
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
					return response()->json(['error'=>'This LAN does not exist.']);
				}
			}else{
				return response()->json(['error'=>'You have to be an admin of this LAN to add games to it.']);
			}
		}else{
			return response()->json(['error'=>'Please login to perform this action.']);
		}
	}

	/**
	* Remove the specified game from the specified LAN
	*
	* @param  int  $id
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function removeGame($id,Request $request){
		if(Auth::check()){
			$user=Auth::user();
			$lan=$user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->find($id);
			if($lan!=null || $user->isSiteAdmin()){
				$lan=Lan::find($id);
				if($lan!=null){
					$game=Game::where('games.id','=',$request->game_id)->join('can_play','can_play.id_game','=','games.id')->where('can_play.id_lan','=',$lan->id)->select('games.id','games.name_game')->first();
					if($game!=null){
						DB::table('can_play')->where('id_lan','=',$lan->id)->where('id_game','=',$game->id)->delete();
						DB::table('uses_port')->where('id_lan','=',$lan->id)->where('id_game','=',$game->id)->delete();
						return response()->json(['success'=>'The game "'.$game->name_game.'" is no longer in this lan\'s game list.']);
					}else{
						return response()->json(['error'=>'This game doesn\'t exist or isn\'t in this lan\'s game list.']);
					}
				}else{
					return response()->json(['error'=>'This LAN does not exist.']);
				}
			}else{
				return response()->json(['error'=>'You have to be an admin of this LAN to remove games from it.']);
			}
		}else{
			return response()->json(['error'=>'Please login to perform this action.']);
		}
	}

	/**
	* Show the form to add a material to a LAN
	*
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function addMaterial($id){
		if(Auth::check()){
			$user=Auth::user();
			$lan=$user->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($id);

			if($lan==null && !$user->isSiteAdmin()){
				return back()->with('error','You have to be an admin or helper of this LAN to add materials to it.');
			}else{
				$lan=Lan::find($id);
				if($lan!=null){
					return view('lan.add_material',compact('lan'));
				}else{
					return back()->with('error','This LAN does not exist.');
				}
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}

	/**
	* Add the specified material to the specified LAN
	*
	* @param  int  $id
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function postAddMaterial($id,Request $request){
		if(Auth::check()){
			$user=Auth::user();
			$lan=$user->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($id);

			if($lan!=null || $user->isSiteAdmin()){
				$lan=Lan::find($id);
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
					return response()->json(['error'=>'This LAN does not exist.']);
				}
			}else{
				return response()->json(['error'=>'You have to be an admin or helper of this LAN to add materials to it.']);
			}
		}else{
			return response()->json(['error'=>'Please login to perform this action.']);
		}
	}

	/**
	* Edit the quantity of the specified material for the specified LAN
	*
	* @param  int  $id
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function editQuantity($id,Request $request){
		if(Auth::check()){
			$user=Auth::user();
			$lan=$user->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($id);

			if($lan!=null || $user->isSiteAdmin()){
				$lan=Lan::find($id);

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
					return response()->json(['error'=>'This LAN does not exist.']);
				}
			}else{
				return response()->json(['error'=>'You have to be an admin or helper of this LAN to edit its material list.']);
			}
		}else{
			return response()->json(['error'=>'Please login to perform this action.']);
		}
	}

	/**
	* Remove the specified material from the specified LAN
	*
	* @param  int  $id
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function removeMaterial($id,Request $request){
		if(Auth::check()){
			$user=Auth::user();
			$lan=$user->lans()->where(function($query){
				$query->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->orWhere('lan_user.rank_lan','=',config('ranks.HELPER'));
			})->find($id);
			if($lan!=null || $user->isSiteAdmin()){
				$lan=Lan::find($id);
				if($lan!=null){
					$material=Material::where('materials.id','=',$request->material_id)->join('needs','needs.id_material','=','materials.id')->where('needs.id_lan','=',$lan->id)->select('materials.id','materials.name_material')->first();
					if($material!=null){
						DB::table('needs')->where('id_lan','=',$lan->id)->where('id_material','=',$material->id)->delete();
						return response()->json(['success'=>'The material "'.$material->name_material.'" is no longer in this lan\'s material list.']);
					}else{
						return response()->json(['error'=>'This material doesn\'t exist or isn\'t in this lan\'s material list.']);
					}
				}else{
					return response()->json(['error'=>'This LAN does not exist.']);
				}
			}else{
				return response()->json(['error'=>'You have to be an admin or helper of this LAN to remove materials from it.']);
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
			$logged_user=Auth::user();
			$lan=Lan::find($id);
			if($lan!=null){
				$user=$logged_user->join('lan_user','lan_user.user_id','=','users.id')->where('lan_id','=',$id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->select('lan_user.id')->first();
				if($user!=null || $logged_user->isSiteAdmin()){
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
	* List all the accepted and not started LANs
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function list_all(Request $request){
		$lans = Lan::where('waiting_lan','=',config('waiting.ACCEPTED'))->where('opening_date','>',date('Y-m-d'))->whereExists(function($query){
			$query->select('lan_user.id')
						->from('lan_user')
						->where('lan_user.rank_lan','=',config('ranks.ADMIN'))
						->whereRaw('lan_user.lan_id=lans.id')
						->join('users','lan_user.user_id','=','users.id')
						->whereNull('users.deleted_at');
		})->get();
		if(Auth::check()){
			return view('lan.list_all', compact('lans'));
		}else{
			return view('lan.list_all_external', compact('lans'));
		}
	}

	/**
	* List all the Games of a LAN
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function list_games($id, $page = 1){
		if(Auth::check()){
			$lan = Lan::find($id);
			if($lan!=null){
				$user=Auth::user();
				$userIsLanAdmin=$user->isSiteAdmin() || $user->lans()->where('lans.id','=',$id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;

				$tgames=$lan->games;
				$nlan = $lan->name;
				$games=$lan->games->forPage($page, 10);

				$max = ceil(count($tgames)/10);

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
				$ports=$games->toBase();
				foreach($ports as $index=>$game){
					$ports[$index]=$game->ports()->where('uses_port.id_lan','=',$lan->id)->get();
				}

				return view('lan.complete_lists.games', compact('games', 'ports', 'nlan', 'id', 'userIsLanAdmin', 'max', 'previous', 'next', 'page'));
			}else{
				return back()->with('error','This LAN does not exist.');
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}

	/**
	* List all the tasks of a LAN
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function list_tasks($id, $page = 1){
		if(Auth::check()){
			$lan = Lan::find($id);

			if($lan!=null){
				$user=Auth::user();
				$userIsLanAdmin=$user->isSiteAdmin() || $user->lans()->where('lans.id','=',$id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;
				$userIsLanHelper=$user->isSiteAdmin() || $user->lans()->where('lans.id','=',$id)->where('lan_user.rank_lan','=',config('ranks.HELPER'))->first()!=null;

				if(!$userIsLanHelper && !$userIsLanAdmin){
					return back()->with('error','You can\'t view a LAN\'s tasks if you are not admin or helper on this LAN.');
				}else{
					$ttasks=$lan->tasks;
					$nlan = $lan->name;
					$tasks=$lan->tasks->forPage($page, 10);

					$max = ceil(count($ttasks)/10);

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

					return view('lan.complete_lists.tasks', compact('tasks', 'nlan', 'id', 'userIsLanAdmin', 'max', 'previous', 'next', 'page','lan'));
				}
			}else{
				return back()->with('error','This LAN does not exist.');
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}

	/**
	* List all the materials of a LAN
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function list_materials($id, $page = 1){
		if(Auth::check()){

			$lan = Lan::find($id);

			if($lan!=null){
				$user=Auth::user();
				$userIsLanAdmin=$user->isSiteAdmin() || $user->lans()->where('lans.id','=',$id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;
				$userIsLanHelper=$user->isSiteAdmin() || $user->lans()->where('lans.id','=',$id)->where('lan_user.rank_lan','=',config('ranks.HELPER'))->first()!=null;

				if(!$userIsLanAdmin && !$userIsLanHelper){
					return back()->with('error','You can\'t view a LAN\'s material list if you are not admin or helper on this LAN.');
				}else{
					$tmat=$lan->materials;
					$nlan = $lan->name;
					$materials=$lan->materials()->select('materials.*','needs.quantity as quantity')->get()->forPage($page, 10);

					$max = ceil(count($tmat)/10);

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

					return view('lan.complete_lists.materials', compact('materials', 'nlan', 'id', 'userIsLanAdmin', 'max', 'previous', 'next', 'page'));
				}
			}else{
				return back()->with('error','This LAN does not exist.');
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}
	/**
	* Display the shopping list of a LAN
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function list_shoppings($id, $page = 1){
		if(Auth::check()){
			$lan = Lan::where('id','=',$id)->select('name','id','budget')->first();

			if($lan!=null){
				$user=Auth::user();
				$userIsLanAdmin=$user->isSiteAdmin() || $user->lans()->where('lans.id','=',$id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;
				$userIsLanHelper=$user->isSiteAdmin() || $user->lans()->where('lans.id','=',$id)->where('lan_user.rank_lan','=',config('ranks.HELPER'))->first()!=null;

				if(!$userIsLanHelper && !$userIsLanAdmin){
					return back()->with('error','You can\'t view a LAN\'s shopping list if you are not admin or helper on this LAN.');
				}else{
					$tshop=$lan->shoppings;

					$totalprice_shopping=$lan->price_shopping($tshop);

					$shoppings=$tshop->forPage($page, 10);

					$max = ceil(count($tshop)/10);

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

					return view('lan.complete_lists.shoppings', compact('totalprice_shopping','shoppings', 'lan', 'userIsLanAdmin', 'max', 'previous', 'next', 'page'));
				}
			}else{
				return back()->with('error','This LAN does not exist.');
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}
	/**
	* Display the player list of a LAN
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function list_users($id, $page = 1){
		if(Auth::check()){
			$lan = Lan::find($id);

			if($lan!=null){
				$user=Auth::user();
				$userIsLanAdmin=$user->isSiteAdmin() || $user->lans()->where('lans.id','=',$id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;

				if(!$userIsLanAdmin){
					return back()->with('error','You do not have enough rights to view this LAN\'s player list.');
				}else{
					$tu=$lan->real_users()->where('lan_user.rank_lan','=',config('ranks.PLAYER'))->get();
					$nlan = $lan->name;
					$users=$tu->forPage($page, 10);

					$max = ceil(count($tu)/10);

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

					//reduce users before compacting (limit the amount of information like emails)
					return view('lan.complete_lists.users', compact('users', 'nlan', 'id', 'userIsLanAdmin', 'max', 'previous', 'next', 'page'));
				}
			}else{
				return back()->with('error','This LAN does not exist.');
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}

	/**
	* Display the admin list of a LAN
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function list_admins($id, $page = 1){
		if(Auth::check()){
			$lan = Lan::find($id);
			if($lan!=null){

				$user=Auth::user();
				$userIsLanAdmin=$user->isSiteAdmin() || $user->lans()->where('lans.id','=',$id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;
				if(!$userIsLanAdmin){
					// /!\ redirects to dashboard (not back) to avoid too many redirections
					return redirect('/dashboard')->with('error','You do not have enough rights to view this LAN\'s admins list.');
				}else{
					$tu = $lan->users()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->get();
					$nlan = $lan->name;
					$admins=$lan->users()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->skip(abs(($page - 1)*10))->take(10)->get();

					$max = ceil(count($tu)/10);

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
					//reduce users before compacting (limit the amount of information like emails)

					return view('lan.complete_lists.admins', compact('admins', 'nlan', 'id', 'userIsLanAdmin', 'max', 'previous', 'next', 'page'));
				}
			}else{
				return back()->with('error','This LAN does not exist.');
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}

	/**
	* Display the helper list of a LAN
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function list_helpers($id, $page = 1){
		if(Auth::check()){
			$lan = Lan::find($id);

			if($lan!=null){
				$user=Auth::user();
				$userIsLanAdmin=$user->isSiteAdmin() || $user->lans()->where('lans.id','=',$id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;
				if(!$userIsLanAdmin){
					return back()->with('error','You do not have enough rights to view this LAN\'s helpers list.');
				}else{
					$tu = $lan->users()->where('lan_user.rank_lan','=',config('ranks.HELPER'))->get();
					$nlan = $lan->name;
					$helpers=$lan->users()->where('lan_user.rank_lan','=',config('ranks.HELPER'))->skip(abs(($page - 1)*10))->take(10)->get();

					$max = ceil(count($tu)/10);

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

					//reduce users before compacting (limit the amount of information like emails)
					return view('lan.complete_lists.helpers', compact('helpers', 'nlan', 'id', 'userIsLanAdmin', 'max', 'previous', 'next', 'page'));
				}
			}else{
				return back()->with('error','This LAN does not exist.');
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}

	/**
	* Display the tournament list of a LAN
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function list_tournaments($id, $page = 1){
		if(Auth::check()){
			$lan = Lan::find($id);

			if($lan!=null){
				$user=Auth::user();
				$userIsLanAdmin=$user->isSiteAdmin() || $user->lans()->where('lans.id','=',$id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;

				$tt=$lan->tournaments;
				$nlan = $lan->name;
				$tournaments=$lan->tournaments->forPage($page, 10);

				$max = ceil(count($tt)/10);


				if(($page+1)*10>($max*10)){
					$next = 0;
				}
				else{
					$next = $page + 1;
				}

				if($page == 1){

					$previous = 0;
				}
				else{
					$previous = $page-1;
				}

				return view('lan.complete_lists.tournaments', compact('tournaments', 'nlan', 'id', 'userIsLanAdmin', 'max', 'previous', 'next', 'page'));
			}else{
				return back()->with('error','This LAN does not exist.');
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}

	/**
	* Display the activities list of a LAN
	*
	* @return \Illuminate\Contracts\Support\Renderable
	*/
	public function list_activities($id, $page = 1){
		if(Auth::check()){
			$lan = Lan::where('id','=',$id)->select('name','id')->first();

			if($lan!=null){
				$user=Auth::user();
				$userIsLanAdmin=$user->isSiteAdmin() || $user->lans()->where('lans.id','=',$id)->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->first()!=null;

				$ta=$lan->activities;
				$nlan = $lan->name;
				$activities=$ta->forPage($page, 10);

				$max = ceil(count($ta)/10);

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
				return view('lan.complete_lists.activities', compact('activities', 'lan', 'userIsLanAdmin', 'max', 'previous', 'next', 'page'));
			}else{
				return back()->with('error','This LAN does not exist.');
			}
		}else{
			return redirect('/login')->with('error','Please login to perform this action.');
		}
	}
}
