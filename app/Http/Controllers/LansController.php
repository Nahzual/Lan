<?php

namespace App\Http\Controllers;

use App\Lan;
use App\Location;
use App\City;
use App\Street;
use App\Department;
use App\Country;
use Illuminate\Support\Facades\Auth;

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

		$user = Auth::user();
        $lans = $user->lans;

        if($user->rank_user==1){
			$waiting_lans = Lan::where('waiting_lan','=','1')->get();

			return view('dashboard.admin.index', compact('lans', 'user','waiting_lans'));
        }
        else return view('dashboard.index', compact('lans', 'user'));
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
	public function store(Request $request)
    {
		//Country
		$countries = Country::where('name_country','=',$request->name_country)->get();
		if($countries != null){$country = $countries->first();}
		if(!isset($country)){
			$country = new Country();
			$country->name_country = $request->name_country;
			$country->save();
		}
		//Department
		$department = null;
		$departments = $country->departments;
		if($departments != null){
			foreach($departments as $tdepartment){
				if($tdepartment->name_department == $request->name_department){
					$department = $tdepartment;
					break;
				}
			}
		}
		$department = $country->departments->first();
		if(!isset($department)){
			$department = new Department();
			$department->name_department = $request->name_department;
			//$department->country_id = $country->id_country;
			$department->country()->associate($country);
			$department->save();
		}
		
		//City
		$cities = $department->cities;
		if($cities != null){
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
			//$city->department_id = $department->id;
			$city->department()->associate($department);
			$city->save();
		}
		
		//Street
		$streets = $city->streets;
		if($streets != null){
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
			//$street->city_id = $city->id;
			$street->city()->associate($city);
			$street->save();
		}
		
		//Location
		$locations = $street->locations;
		if($locations != null){
			foreach($locations as $tlocation){
				if($tlocation->num_location == $request->num_location){
					$location = $tlocation;
					break;
				}
			}
		}
		if(!isset($location)){
			$location = new Location();
			$location->num_street = $request->num_location;
			//$location->street_id = $street->id;
			$location->street()->associate($street);
			$location->save();
		}
		
		$lan = new Lan();
		$lan->name = $request->name;
		$lan->max_num_registrants = $request->max_num_registrants;
		$lan->opening_date = $request->opening_date;
		$lan->duration = $request->duration;
		$lan->budget = $request->budget;
		//$lan->location_id = $location->id;
		$lan->location()->associate($location);
		$lan->save();
		
		$lan->users()->attach(Auth::user()->id, ['rank_lan' => 1, 'score_lan' => 0]);
		
		return response()->json([
		'success'=>'Votre Lan a été correctement enregistrées'
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
		if(Auth::check()){
			$lan = Lan::findOrFail($id);
			return view('lan.show', compact('lan'));
		}else{
			return redirect('/home');
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
			if($user->lans()->findOrFail($id)==null && $user->rank!=1){
				return redirect('/home');
			}else{
				$lan = Lan::findOrFail($id);
				return view('lan.edit', compact('lan'));
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
			if($user->lans()->findOrFail($id)==null && $user->rank!=1){
				return redirect('/home');
			}else{
				$lan = Lan::findOrFail($id);
				$lan->update($request->all());
				$lan->save();

				return redirect(route('lan.show', $id));
			}
		}else{
			return redirect('/home');
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