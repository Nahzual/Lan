<?php

namespace App\Http\Controllers;

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

use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function __construct(){
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	   public function store(Request $request){

    		return response()->json([
    		    'success'=>'Votre Lan a été correctement enregistrée'
    		]);
      }

    /**
     * Show the form for editing the logged-in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
  		if(Auth::check()){
          $user=Auth::user();
          if($user->id==$id){
            $location = $user->location;
      			$street = $location->street;
      			$city = $street->city;
      			$department = $city->department;
      			$country = $department->country;
            return view('auth.edit',compact('user','location','street','city','department','country'));
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
    public function update(Request $request, $id)
    {
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
        if($user->id==$id){
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

  				return redirect('/dashboard')->with('success','You successfully edited your profile.');
        }else{
          return redirect('/home')->with('error','You are not allowed to edit other users\' profiles.');
        }
      }else{
        return redirect('/login')->with('error','Please log in to perform this action.');
      }
    }

    /**
     * Display a listing of the resource fitting the Request
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
      $users=User::where('pseudo','LIKE','%'.$request->pseudo.'%')->get();
      $lan=Lan::where('id','=',$request->lan_id)->first();
      return view($request->view_path,compact('users','lan'));
    }

		public function searchHelper($taskID,Request $request)
		{
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		return redirect(route('user.index'));
    }
}
