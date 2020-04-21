<?php

namespace App\Http\Controllers;

use App\Lan;
use App\Location;
use App\City;
use App\Street;
use App\Department;
use App\Country;
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
        $lans = $user->lans()->where('lan_user.rank_lan','=',config('ranks.ADMIN'))->get();

        if($user->rank_user==config('ranks.SITE_ADMIN')){
			       $waiting_lans = Lan::where('waiting_lan','=',config('waiting.WAITING'))->get();
			       return view('dashboard.admin.index', compact('lans', 'user','waiting_lans'));
        }else return view('dashboard.index', compact('lans', 'user'));
      }else{
        return redirect('/');
      }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
	   public function store(Request $request){
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
  			return view('lan.show', compact('lan', 'location', 'street', 'city', 'department', 'country'));
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
  			if($user->lans()->findOrFail($id)==null && $user->rank_user!=config('ranks.SITE_ADMIN')){
  				return redirect('/home');
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
  			return redirect('/home');
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
  			if($user->lans()->find($id)==null && $user->rank!=config('ranks.ADMIN')){
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
        return redirect('/');
      }
    }

    public function postParticipate($id,Request $request){
      if(Auth::check()){
        $lan=Lan::findOrFail($id);
        $place_taken=DB::table('lan_user')->where('lan_id','=',$id)->where('place_number','=',$request->place_number)->select('id')->get();
        if(count($place_taken)==0){
          $user=Auth::user();
          $lan->users()->attach($user,['rank_lan'=>config('ranks.PLAYER'),'score_lan'=>'0','place_number'=>$request->place_number]);
          return response()->json(['success'=>'You have been successfully registered to this LAN.']);
        }else{
          return response()->json(['error'=>'This place has already been taken, please choose another one.']);
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
		$lan = Auth::user()->lans()->findOrFail($id);

		//Supprime la lan
		$lan->delete();
		return redirect(route('lan.index'));
    }
}
