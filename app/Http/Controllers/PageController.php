<?php

namespace App\Http\Controllers;

use App\Lan;
use App\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PageController extends Controller{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct(){}

		/**
		* Show the application homepage.
		*
		* @return \Illuminate\Contracts\Support\Renderable
		*/
		public function home(Request $request){
			$lan = Lan::where('waiting_lan','=',config('waiting.ACCEPTED'))->where('opening_date','>',date('Y-m-d'))->orderBy('created_at','desc')->first();
			return view('home', compact('lan'));
		}

		/**
		* Shows all LANs which are between two dates and in a specific country, department or city
		*
		* @return \Illuminate\Contracts\Support\Renderable
		*/
		public function allLansList(Request $request){
			if(Auth::check()){
				$lans = Lan::where('waiting_lan','=',config('waiting.ACCEPTED'))->where('opening_date','>',date('Y-m-d'))->whereExists(function($query){
					$query->select('lan_user.id')
								->from('lan_user')
								->where('lan_user.rank_lan','=',config('ranks.ADMIN'))
								->whereRaw('lan_user.lan_id=lans.id')
								->join('users','lan_user.user_id','=','users.id')
								->whereNull('users.deleted_at');
				});

				// lan research based on location
				if(Auth::check() && isset($request->location)){
					$user=User::where('users.id','=',Auth::user()->id)
					->join('locations','users.location_id','=','locations.id')
					->join('streets','locations.street_id','=','streets.id')
					->join('cities','streets.city_id','=','cities.id')
					->join('departments','cities.department_id','=','departments.id')
					->join('countries','departments.country_id','=','countries.id')
					->select('users.id as userID','locations.id as locationID','streets.id as streetID','cities.id as cityID','departments.id as depID','countries.id as countryID')->first();

					$lans=$lans->join('locations','lans.location_id','=','locations.id');

					switch($request->location){
						case 'country': $lans=$lans->join('streets','locations.street_id','=','streets.id')
						->join('cities','streets.city_id','=','cities.id')
						->join('departments','cities.department_id','=','departments.id')
						->join('countries','departments.country_id','=','countries.id')
						->where('countries.id','=',$user->countryID); break;

						case 'department': $lans=$lans->join('streets','locations.street_id','=','streets.id')
						->join('cities','streets.city_id','=','cities.id')
						->join('departments','cities.department_id','=','departments.id')
						->where('departments.id','=',$user->depID); break;

						case 'city': $lans=$lans->join('streets','locations.street_id','=','streets.id')
						->join('cities','streets.city_id','=','cities.id')
						->where('cities.id','=',$user->cityID); break;
						default: break;
					}
				}

				// lan research based on opening date
				if(isset($request->date1) && isset($request->date2)){
					$lans=$lans->where('lans.opening_date','>=',$request->date1)->where('lans.opening_date','<=',$request->date2);
				}

				$lans=$lans->select('lans.*')->get();
				return view('lan.all_lans_list',compact('lans'));
			}else{
				// lan research based on opening date
				$lans = Lan::where('waiting_lan','=',config('waiting.ACCEPTED'))->where('opening_date','>',date('Y-m-d'));
				if(isset($request->date1) && isset($request->date2)){
					$lans=$lans->where('lans.opening_date','>=',$request->date1)->where('lans.opening_date','<=',$request->date2);
				}

				$lans=$lans->select('lans.*')->get();
				return view('lan.all_lans_list_external',compact('lans'));
			}
		}

		/**
		* Shows the contact page
		*
		* @return \Illuminate\Contracts\Support\Renderable
		*/
		public function contact(){
			return view('contact');
		}

		/**
		* Shows the privacy policy page
		*
		* @return \Illuminate\Contracts\Support\Renderable
		*/
		public function privacy(){
			return view('privacy');
		}

		/**
		* Shows the user dashboard
		*
		* @return \Illuminate\Contracts\Support\Renderable
		*/
		public function dashboard(){
			if(Auth::check()){
				$user = Auth::user();
				$admin_lans = $user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->get();
				$helper_lans = $user->lans()->where('lan_user.rank_lan','=',config('ranks.HELPER'))->get();
				$player_lans = $user->lans()->where('lan_user.rank_lan','=',config('ranks.PLAYER'))->get();

				return view('dashboard.index',compact('user','admin_lans','helper_lans','player_lans'));
			}else{
				return redirect('/login')->with('error','Please log in to have access to this page.');
			}
		}

		/**
		* Shows the admin dashboard
		*
		* @return \Illuminate\Contracts\Support\Renderable
		*/
		public function adminDashboard(){
			if(Auth::check()){
				$user = Auth::user();
				if($user->isSiteAdmin()){
					$waiting_lans = Lan::where('waiting_lan','=',config('waiting.WAITING'))->get();
					$latest_users = User::orderBy('created_at','desc')->limit(5)->get();
					$latest_deleted_users = User::onlyTrashed()->orderBy('deleted_at','desc')->limit(5)->get();
					return view('dashboard.admin.index',compact('waiting_lans','latest_users','latest_deleted_users'));
				}else{
					return redirect('/dashboard')->with('error','You don\'t have enough rights to access this page.');
				}
			}else{
				return redirect('/login')->with('error','Please log in to have access to this page.');
			}
		}
}
