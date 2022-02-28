<?php
namespace App\Http\Controllers;
use App\Events\CustomerCreated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Cache;
use Tests\Feature\GardenerTest;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function testUserInput(Request $request){
        $cust =  $request->isCustomer;
        GardenerTest::assertEquals('Customer', $cust);
    }
    public function register(Request $request)
    {
        // TODO: Validation for the inputs
        if(!isset($request->fullname) || $request->fullname =='')return response(['message' => 'Name cannot be blank'], 400);
        if(!isset($request->email) || $request->email =='')return response(['message' => 'Email cannot be blank'], 400);
        if(!isset($request->password) || $request->password =='')return response(['message' => 'Password cannot be empty'], 400);
        if(!isset($request->location) || $request->location =='')return response(['message' => 'Please fill in your location'], 400);
        if(!isset($request->country) || $request->country =='')return response(['message' => 'Please fill in your country'], 400);
        if(!isset($request->isCustomer) || $request->isCustomer =='')return response(['message' => 'isCustomer field cannot be empty'], 400);

        $cust =  $request->isCustomer;

        // determines if the user to be created is customer or gardener
        if($cust == 'true'){
            $user_type = "Customer";
            $request->is_customer = true;
        }
        else {
            $user_type = "Gardener";
            $request->is_customer = false;
        }

        // country must be either Nigeria or Kenya
        $country = array('Nigeria', 'Kenya');
        $check = in_array($request->country,$country);
        if(!$check)return response(['message' => 'Country must be Nigeria or Kenya'], 400);

        // if all checks passes, create the new user -- customer or gardener
        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'location' => $request->location,
            'country' => $request->country,
            'is_customer' => $request->is_customer
        ]);

        // An event should fire to assign a gardener if the newly-created user is a customer
        $customer = $user->email;
        if($user_type == "Customer")CustomerCreated::dispatch($customer);
        //event(new CustomerCreated($customer));


        return response(['message' => $user_type .' - '.$request->fullname.' created successfully'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCustomers()
    {
        // server-side caching using the file cache method to return list of customers in the cache
        // or make a fresh query to the db if it doesn't exist and then save the cache for 10 minutes
        //$customers =  Cache::remember('customers', 600, function (){
            $customers = User::select('fullname', 'email' ,'location','country','assigned_gardener')
                ->where('is_customer', '=', 1)
                ->get();
            return response([ 'customers' => UserResource::collection($customers),
                               'message' => 'Customers Retrieved successfully'], 200);
       // });
        //return response()->json($customers)->getOriginalContent();
    }

    public function getGardeners()
    {

            $gardeners =  Cache::remember('gardeners', 600, function () {
            $gardeners = User::select('fullname as gardener_name', 'location', 'country', 'assigned_customer')
                ->where('is_customer', '=', 0)
                ->orderBy('country', 'ASC')
                ->get()
                ->toArray();

            $count = 0;
            $xi = 0;
            $gardener_response = array();
            foreach ($gardeners as $gardener) {
                if (is_null(($gardener['assigned_customer']))) $gardener['assigned_customer'] = array();
                $count = count($gardener['assigned_customer']);

                $gardener_response[$xi]['gardener_name'] = $gardener['gardener_name'];
                $gardener_response[$xi]['location'] = $gardener['location'];
                $gardener_response[$xi]['country'] = $gardener['country'];
                $gardener_response[$xi]['assigned_customers'] = $gardener['assigned_customer'];
                $gardener_response[$xi]['no_of_customers'] = $count;
                $xi++;
            }

            return response([ 'gardeners' => UserResource::collection($gardener_response),
                              'message' => 'Gardeners Retrieved successfully'],
                               200);
        });
        return response()->json($gardeners)->getOriginalContent();

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
