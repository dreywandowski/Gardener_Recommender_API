<?php

namespace App\Listeners;

use App\Events\CustomerCreated;
use App\Http\Resources\UserResource;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

class AssignGardenerToCustomer
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\CustomerCreated $event
     * @return void
     */
    public function handle(CustomerCreated $event)
    {
        if ($event->customer) {
            // gets customer and gardener location and country
            $customer_loc = User::select('location', 'country', 'fullname')
                ->where('email', '=', $event->customer)
                ->get()
                 ->toArray();


            $gardner_loc = User::select('location', 'country', 'fullname', 'email')
                ->where([
                    'location'     => $customer_loc[0]['location'],
                     'country'     => $customer_loc[0]['country'],
                     'is_customer' => 0
            ])
                ->get();

            // only assign for active locations and countries
            if(!$gardner_loc->isEmpty())$gardner_loc->random(1)->toArray();

           // print_r($gardner_loc);die;

            $gardner = $gardner_loc[0]['fullname'];
            $customer = $customer_loc[0]['fullname'];
            $customer_mail = $event->customer;
            $gardner_mail = $gardner_loc[0]['email'];

            // check against the users table if location and country of both customer and garderner match
            if ($customer_loc[0]['location'] == $gardner_loc[0]['location'] && $customer_loc[0]['country'] == $gardner_loc[0]['country']) {
                // assign gardener to customer
                $this->assignGardener($customer_mail, $gardner);

                // add customer to list of customers under gardener
                $this->assignCustomer($gardner_mail, $customer);

            }
        }
    }

    private function assignGardener($customer_mail, $gardner)
    {
        $gardner_assigned = User::where('email',$customer_mail)->first();
        if ($gardner_assigned) {
            $gardner_assigned->assigned_gardener = $gardner;
            $gardner_assigned->save();
        }

    }

    private function assignCustomer($gardner_mail, $customer)
    {
        $customer_assigned = User::where('email',$gardner_mail)->first();
        if ($customer_assigned) {
            function getUserArray($customer)
            {
                return explode(',', $customer);
            }
            $customer = getUserArray($customer);

            if(is_null($customer_assigned->assigned_customer)){
                $customer_assigned->assigned_customer = array();
}
            $customer = array_merge($customer_assigned->assigned_customer, $customer);
            $customer_assigned->assigned_customer = $customer;
            $customer_assigned->save();
        }

    }
}
