<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Country;
use App\City;
use App\Street;
use App\Department;
use App\Location;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:24'],
			      'lastname' => ['required', 'string', 'max:24'],
			      'pseudo' => ['required', 'string', 'max:24', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			      'tel_user' => ['required', 'unique:users','digits:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
						'name_country' => ['required', 'string'],
						'name_department' => ['required', 'string'],
						'name_city' => ['required', 'string'],
						'zip_city' => ['required', 'digits:5'],
						'name_street' => ['required','string'],
						'num_street' => ['required', 'integer','min:1'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data){
      $countries = Country::where('name_country','=',$data['name_country'])->get();
      if($countries != null){$country = $countries->first();}
      if(!isset($country)){
        $country = new Country();
        $country->name_country = $data['name_country'];
        $country->save();
      }else{
        $departments = $country->departments;
      }
      //Department
      if(isset($departments)){
        foreach($departments as $tdepartment){
          if($tdepartment->name_department == $data['name_department']){
            $department = $tdepartment;
            break;
          }
        }
      }
      if(!isset($department)){
        $department = new Department();
        $department->name_department = $data['name_department'];
        $department->country()->associate($country);
        $department->save();
      }else{
        $cities = $department->cities;
      }

      //City
      if(isset($cities)){
        foreach($cities as $tcity){
          if($tcity->name_city == $data['name_city'] && $tcity->zip_city == $data['zip_city']){
            $city = $tcity;
            break;
          }
        }
      }
      if(!isset($city)){
        $city = new City();
        $city->name_city = $data['name_city'];
        $city->zip_city = $data['zip_city'];
        $city->department()->associate($department);
        $city->save();
      }else{
        $streets = $city->streets;
      }

      //Street
      if(isset($streets)){
        foreach($streets as $tstreet){
          if($tstreet->name_street == $data['name_street']){
            $street = $tstreet;
            break;
          }
        }
      }
      if(!isset($street)){
        $street = new Street();
        $street->name_street = $data['name_street'];
        $street->city()->associate($city);
        $street->save();
      }else{
        $locations = $street->locations;
      }

      //Location
      if(isset($locations)){
        foreach($locations as $tlocation){
          if($tlocation->num_street == $data['num_street']){
            $location = $tlocation;
            break;
          }
        }
      }
      if(!isset($location)){
        $location = new Location();
        $location->num_street = $data['num_street'];
        $location->street()->associate($street);
        $location->save();
      }

        $user=new User();
        $user->name=$data['name'];
        $user->lastname=$data['lastname'];
        $user->pseudo=$data['pseudo'];
        $user->email=$data['email'];
			  $user->tel_user = $data['tel_user'];
        $user->password = Hash::make($data['password']);
        $user->location()->associate($location);
        $user->save();

        return $user;
    }
}
