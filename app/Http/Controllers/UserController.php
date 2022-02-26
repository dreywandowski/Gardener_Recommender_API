<?php
namespace App\Http\Controllers;
use App\Events\CustomerCreated;
use App\Http\Resources\LocationResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;


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

    public function register(Request $request)
    {
        // determines if the user to be created is customer or gardener
        if($request->isCustomer == 1){
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
        $customers = User::select('fullname', 'email' ,'assigned_gardener')->where('is_customer', '=', 1)->get();
        return response([ 'customers' => UserResource::collection($customers), 'message' => 'Customers Retrieved successfully'], 200);
    }

    public function getGardeners()
    {
        $gardeners = User::select('fullname', 'country', 'assigned_customer')->where('is_customer', '=', 0)->orderBy('country', 'ASC')->get();
        //$gardeners->assigned_customer = count($gardeners->assigned_customer);
        return response([ 'gardeners' => UserResource::collection($gardeners), 'message' => 'Gardeners Retrieved successfully'], 200);
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
