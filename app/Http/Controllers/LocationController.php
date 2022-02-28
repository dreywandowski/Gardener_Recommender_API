<?php

namespace App\Http\Controllers;
use App\Models\Locations;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Resources\LocationResource;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /* $locations = Locations::select('locations.location', 'locations.country' ,'fullname')
                     ->join('users', 'users.location', '=', 'locations.location')
                     ->where('users.is_customer', '=', 1)
                     ->orderBy('locations.country', 'DESC')
                     ->get();*/

        // server-side caching using the file cache method to return list of locations in the cache
        // or make a fresh query to the db if it doesn't exist and then save the cache for 10 minutes
            $locations =  Cache::remember('locations', 600, function () {
            $locations = Locations::select('location', 'country')
                ->get()
                ->toArray();

            $location_response = array();

            $xi = 0;
            foreach ($locations as $location) {
                $customers = User::select('fullname as customer_name')
                    ->where('is_customer', '=', 1)
                    ->where('location', '=', $location['location'])
                    ->get()
                    ->toArray();

                $customers = array_map('current', $customers);
               //print_r($customers);

                $location_response[$xi]['location'] = $location['location'];
                $location_response[$xi]['country'] = $location['country'];
                $location_response[$xi]['customers'] = $customers;
                $xi++;
            }

            return response(['locations' => LocationResource::collection($location_response),
                'message' => 'Locations Retrieved successfully'],
                200);
        });
        return response()->json($locations)->getOriginalContent();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
