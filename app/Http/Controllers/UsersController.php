<?php

namespace App\Http\Controllers;

use App;
use App\Lan;
use App\Location;
use App\City;
use App\Street;
use App\Department;
use App\Country;
use App\User;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class UsersController extends Controller{

	public function __construct(){
		$this->middleware('auth');
	}

	/**
	* Show the form for editing a user
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function edit($id){
		if(Auth::check()){
			$user=Auth::user();
			if($user->id==$id || $user->isSiteAdmin()){
				if($user->id!=$id) $user=User::find($id);
				if($user!=null){
					$location = $user->location;
					$street = $location->street;
					$city = $street->city;
					$department = $city->department;
					$country = $department->country;
					return view('auth.edit',compact('user','location','street','city','department','country'));
				}else{
					return back()->with('error','This user doesn\'t exist.');
				}
			}else{
				return redirect('/home')->with('error','You are not allowed to edit other users\' profiles.');
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

		if(!isset($request->password) && !isset($request->password_confirmation)){
			unset($request->password);
			unset($request->password_confirmation);
		}

		$this->validate($request, [
			'name' => ['required', 'string', 'max:24'],
			'lastname' => ['required', 'string', 'max:24'],
			'pseudo' => ['required', 'string', 'max:24',Rule::unique('users')->ignore($id)],
			'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($id)],
			'tel_user' => ['required','digits:10',Rule::unique('users')->ignore($id)],
			'password' => ['nullable','string', 'min:8', 'confirmed']
		]);

		if(Auth::check()){
			$user=Auth::user();
			$logged_user=$user;
			if($user->id==$id || $user->isSiteAdmin()){
				if($user->id!=$id){
					$user=User::find($id);
				}
				if($user!=null){
					$location = $user->location;
					$user_location=$location;
					$street = $location->street;
					$user_street=$street;
					$city = $street->city;
					$user_city=$city;
					$department = $city->department;
					$user_department=$department;
					$country = $department->country;
					$user_country=$country;

					//Country
					if(isset($request->name_country) && $request->name_country!=$country->name_country){

						$countries = Country::where('name_country','=',$request->name_country)->get();
						if($countries != null){$country = $countries->first();}
						if(!isset($country)){
							$country = new Country();
							$country->name_country = htmlentities($request->name_country);
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

					if(!isset($department) || $country!=$user_country){
						$department = new Department();
						$department->name_department = htmlentities($request->name_department);
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

					if(!isset($city) || $department!=$user_department){
						$city = new City();
						$city->name_city = htmlentities($request->name_city);
						$city->zip_city = htmlentities($request->zip_city);
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

					if(!isset($street) || $city!=$user_city){
						$street = new Street();
						$street->name_street = htmlentities($request->name_street);
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

					if(!isset($location) || $street!=$user_street){
						$location = new Location();
						$location->num_street = htmlentities($request->num_street);
						$location->street()->associate($street);
						$location->save();
					}

					if($location!=$user_location) $user->location()->associate($location);

					$user->name=htmlentities($request->name);
					$user->lastname=htmlentities($request->lastname);
					$user->pseudo=htmlentities($request->pseudo);
					if(isset($request->password) && isset($request->password_confirmation) && !Hash::check($user->password,$request->password))
					$user->password=Hash::make($request->password);
					$user->email=htmlentities($request->email);
					$user->tel_user=htmlentities($request->tel_user);
					$user->theme=0;
					$user->save();

					if($user->id==$logged_user->id) return back()->with('success','You successfully edited your profile.');
					else return back()->with('success','This user\'s account has been successfully edited.');
				}else{
					return back()->with('error','This user does not exist.');
				}
			}else{
				return redirect('/home')->with('error','You are not allowed to edit other users\' profiles.');
			}
		}else{
			return redirect('/login')->with('error','Please log in to perform this action.');
		}
	}

	/**
	* Displays the provided resource
	* @param  int  $id
	*/
	public function show($id){
		if(Auth::check()){
			$user=User::find($id);
			if($user!=null){
				$location = $user->location;
				$street = $location->street;
				$city = $street->city;
				$department = $city->department;
				$country = $department->country;

				//statistics
				$lans_admin_count=$user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->where('lans.opening_date','<',date('Y-m-d'))->selectRaw('COUNT(lan_user.id) as count')->groupBy('lan_user.id')->first();
				$lans_former_admin_count=$user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->where('lans.opening_date','>=',date('Y-m-d'))->selectRaw('COUNT(lan_user.id) as count')->groupBy('lan_user.id')->first();
				$lans_helper_count=$user->lans()->where('lan_user.rank_lan','=',config('ranks.HELPER'))->where('lans.opening_date','<',date('Y-m-d'))->selectRaw('COUNT(lan_user.id) as count')->groupBy('lan_user.id')->first();
				$lans_former_helper_count=$user->lans()->where('lan_user.rank_lan','=',config('ranks.HELPER'))->where('lans.opening_date','>=',date('Y-m-d'))->selectRaw('COUNT(lan_user.id) as count')->groupBy('lan_user.id')->first();
				$lans_player_count=$user->lans()->where('lan_user.rank_lan','=',config('ranks.PLAYER'))->where('lans.opening_date','<',date('Y-m-d'))->selectRaw('COUNT(lan_user.id) as count')->groupBy('lan_user.id')->first();
				$lans_former_player_count=$user->lans()->where('lan_user.rank_lan','=',config('ranks.PLAYER'))->where('lans.opening_date','>=',date('Y-m-d'))->selectRaw('COUNT(lan_user.id) as count')->groupBy('lan_user.id')->first();

				$lans_admin_count=($lans_admin_count!=null) ? $lans_admin_count->count : 0;
				$lans_former_admin_count=($lans_former_admin_count!=null) ? $lans_former_admin_count->count : 0;
				$lans_helper_count=($lans_helper_count!=null) ? $lans_helper_count->count : 0;
				$lans_former_helper_count=($lans_former_helper_count!=null) ? $lans_former_helper_count->count : 0;
				$lans_player_count=($lans_player_count!=null) ? $lans_player_count->count : 0;
				$lans_former_player_count=($lans_former_player_count!=null) ? $lans_former_player_count->count : 0;

				return view('user.show',compact('user','location','street','city','department','country','lans_admin_count','lans_helper_count','lans_player_count','lans_former_admin_count','lans_former_helper_count','lans_former_player_count'));
			}else{
				return back()->with('error','This user does not exist.');
			}
		}else{
			return redirect('/login')->with('error','Please log in to have access to this page.');
		}
	}

	/**
	* Display a listing of the resource fitting the Request
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function search(Request $request){
		$users=User::where('pseudo','LIKE','%'.$request->pseudo.'%')->get();
		$lan=Lan::where('id','=',$request->lan_id)->first();
		if($lan!=null){
			return view($request->view_path,compact('users','lan'));
		}else{
			return view('errors.404_include');
		}
	}

	/**
	* Display a listing of the resource fitting the Request
	* @param  int  $taskId
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function searchHelper($taskID,Request $request){
		$task=Task::find($taskID);
		if($task!=null){
			$lan=$task->lan;
			$users=$lan->users()->where('lan_user.rank_lan','=',config('ranks.HELPER'))->where('pseudo','LIKE','%'.$request->pseudo.'%')->get();
			return view('user.helper.show_add_task',compact('users','lan','task'));
		}else{
			return view('errors.404_include');
		}
	}


	/**
	* Sends a mail to the user
	* @param  int  $userId
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/

	public function contact($userID){
		if(Auth::check()){
			$from=Auth::user();
			$to=User::find($userID);
			if($to!=null){
				try{
					Mail::send('mails.notification_contact', ['from' => $from,'to'=>$to], function ($message) use ($to) {
						$message->from('lancreator.noreply@gmail.com','LAN Creator')
						->to($to->email)
						->subject('A user tried to contact you');
					});
					return response()->json(['success'=>'Your message has been successfully sent.']);
				}catch(\Exception $e){
					return response()->json(['error'=>'Your message couldn\'t be sent due to an internal server error. If the problem persists, please contact an administrator.']);
				}
			}else{
				return response()->json(['error'=>'This user does not exist.']);
			}
		}else{
			return response()->json(['error'=>'Please log in to perform this action.']);
		}
	}

	/**
	*	Show a page to make sure that the logged user wanted to delete his account
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function confirmDestroy(){
		if(Auth::check()){
			return view('user.confirm_destroy');
		}else{
			return redirect('/login')->with('error','Please log in to perform this action');
		}
	}

	/**
	* SoftRemove the specified resource from storage.
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function destroy($id){
		if(Auth::check()){
			$logged_user=Auth::user();
			if($logged_user->id==$id || $logged_user->isSiteAdmin()){
				$user=User::find($id);
				if($user!=null){
					// free places taken by this user
					$player_lans=$user->lans()->where('lan_user.rank_lan','=',config('ranks.PLAYER'))->select('lan_user.place_number_x','lan_user.place_number_y','lan_user.id AS lan_user_id','lan_user.lan_id')->get();

					foreach($player_lans as $lan){
						$x=$lan->place_number_x;
						$y=$lan->place_number_y;
						$p_id=$lan->lan_user_id;
						$lan_id=$lan->lan_id;
						$file_name="../storage/lans/room_plan_".$lan_id.".json";

						if(file_exists($file_name)){
							$room=json_decode(file_get_contents($file_name));
							$room->room->field[$y][$x]=config('room.EMPTY_CHAIR');
							file_put_contents($file_name,json_encode($room));
						}
						DB::table('lan_user')->where('lan_user.id','=',$p_id)->delete();
					}

					if($user->id==$logged_user->id){
						Auth::logout();
						$user->delete();
						return redirect('/')->with('success','Your account has been successfully disabled.');
					}else{
						$user->delete();
						try{
							Mail::send('mails.notification_ban',[], function ($message) {
								$message->from('lancreator.noreply@gmail.com','LAN Creator')
								->to($user->email)
								->subject('Your have been banned from LanCreator');
							});
						}catch(\Exception $e){

						}
						return response()->json(['success'=>'This user has been successfully banned from LanCreator.','html'=>view('user.show_restore',compact('user'))->render() ]);
					}
				}else{
					return response()->json(['error'=>'This user does not exist.']);
				}
			}else{
				return response()->json(['error'=>'You don\'t have enough rights to perform this action.']);
			}
		}else{
			return response()->json(['error'=>'Please log in to perform this action.']);
		}
	}

	/**
	* HardDelete the specified resource from storage.
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function forceDestroy($id){
		if(Auth::check()){
			$logged_user=Auth::user();
			if($logged_user->id==$id){
				// free places taken by this user
				$player_lans=$logged_user->lans()->where('lan_user.rank_lan','=',config('ranks.PLAYER'))->select('lan_user.place_number_x','lan_user.place_number_y','lan_user.id AS lan_user_id','lan_user.lan_id')->get();

				foreach($player_lans as $lan){
					$x=$lan->place_number_x;
					$y=$lan->place_number_y;
					$p_id=$lan->lan_user_id;
					$lan_id=$lan->lan_id;
					$file_name="../storage/lans/room_plan_".$lan_id.".json";

					if(file_exists($file_name)){
						$room=json_decode(file_get_contents($file_name));
						$room->room->field[$y][$x]=config('room.EMPTY_CHAIR');
						file_put_contents($file_name,json_encode($room));
					}
				}

				Auth::logout();
				$logged_user->forceDelete();
				return redirect('/')->with('success','Your account has been successfully deleted.');
			}else{
				return back()->with('error','You can\'t delete other users\' accounts.');
			}
		}else{
			return back()->with('error','Please log in to perform this action.');
		}
	}

	/**
	* Restore the specified resource from storage.
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function restore($id){
		if(Auth::check()){
			$logged_user=Auth::user();
			if($logged_user->isSiteAdmin()){
				$user=User::onlyTrashed()->find($id);
				if($user!=null){
					$user->restore();
					try{
						Mail::send('mails.notification_restore',[], function ($message) {
							$message->from('lancreator.noreply@gmail.com','LAN Creator')
							->to($user->email)
							->subject('Your LanCreator account has been restored');
						});
					}catch(\Exception $e){

					}
					return response()->json(['success'=>'This user\'s account has been successfully restored.','html'=>view('user.show_delete',compact('user'))->render() ]);
				}else{
					return response()->json(['error'=>'This user hasn\'t been deleted.']);
				}
			}else{
				return response()->json(['error'=>'You don\'t have enough rights to perform this action.']);
			}
		}else{
			return response()->json(['error'=>'Please log in to perform this action.']);
		}
	}

	/**
	* User List
	* @param  int  $page
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Contracts\Support\Renderable
	*/

	public function admList($page = 1,Request $request){
		if(Auth::check()){
			$user=Auth::user();
			if(!$user->isSiteAdmin()){
				return back()->with('error','You are not an Admin');
			}else{
				if(isset($request->pseudo)){
					$tu = User::withTrashed()->where('pseudo','LIKE','%'.$request->pseudo.'%')->selectRaw('COUNT(*) AS count')->first();
					if($tu!=null){
						$tu=$tu->count;
					}else{
						$tu=0;
					}
					$users= User::withTrashed()->where('pseudo','LIKE','%'.$request->pseudo.'%')->skip(abs(($page - 1)*10))->take(10)->get();
				}else{
					$tu = User::withTrashed()->selectRaw('COUNT(*) AS count')->first();
					if($tu!=null){
						$tu=$tu->count;
					}else{
						$tu=0;
					}
					$users= User::withTrashed()->skip(abs(($page - 1)*10))->take(10)->get();
				}

				$max = ceil($tu/10);

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
				return view('user.list', compact('users', 'max', 'previous', 'next', 'page'))->with('username',$request->pseudo);
			}
		}else{
			return redirect('/login')->with('error','Please log in to perform this action.');
		}
	}

	/**
	* Change the site's theme for the specified user
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/
	public function updateTheme($id){
		if(htmlentities($id)){
			if(Auth::check()){
				$user=Auth::user();
				if($user->id==htmlentities($id)){
					$user->theme = $user->theme+1;
					if($user->theme > 2){
						$i = random_int(0, 201);
						if($i < 199){
							$user->theme = 0;
						}else{
							$user->theme = 3;
						}
					}
					$user->save();
					return back()->with('success','Enjoy your new theme.');
				}else{
					return redirect('/home')->with('error','You are not allowed to edit other users\' profiles.');
				}
			}else{
				return redirect('/login')->with('error','Please log in to perform this action.');
			}
		}else{
			return redirect('/dashboard')->with('error','An error occured while updating your settings. Please try again');
		}
	}

	/**
	* Change the site's language for the specified user
	* @param  int  $id
	* @return \Illuminate\Http\Response
	*/

	public function updateLanguage($id){
		if(htmlentities($id)){
			if(Auth::check()){
				$user=Auth::user();
				if($user->id==htmlentities($id)){
					$user->language = $user->language+1;
					if($user->language > 1){
						$user->language = 0;
					}
					if ($user->language == 0){
						session(['locale'=> "fr"]);
					}else if ($user->language == 1){
						session(['locale'=> "en"]);
					}
					else {
						session(['locale'=> "en"]);
					}
					$user->save();
					return back()->with('success','Enjoy your new language.');

				}else{
					return redirect('/home')->with('error','You are not allowed to edit other users\' profiles.');
				}
			}else{
				return redirect('/login')->with('error','Please log in to perform this action.');
			}

		}else{
			return redirect('/dashboard')->with('error','An error occured while updating your settings. Please try again');
		}
	}
}
