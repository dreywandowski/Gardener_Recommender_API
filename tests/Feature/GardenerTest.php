<?php

namespace Tests\Feature;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Box;

class GardenerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // test locations endpoint
    public function test_get_locations()
    {
        $response = $this->get('/api/locations');

        $response->assertStatus(200);
    }

    // test customers endpoint
    public function test_get_customers()
    {
        $response = $this->get('/api/customers');

        $response->assertStatus(200);
    }

    // test gardners endpoint
    public function test_get_gardeners()
    {
        $response = $this->get('/api/gardeners');

        $response->assertStatus(200);
    }

    // test create customer or gardener endpoint
    public function test_create_customer_endpoint()
    {
        $response = $this->post('/api/register', ['fullname' => 'Sally Customer',
                                                      'email' => 'feature@test.com',
                                                      'password' => '!@#980gfhf',
                                                      'location' => 'Lagos',
                                                      'country' => 'Nigeria',
                                                       'isCustomer' => true
                                                           ]);

        $response->assertStatus(201);
    }

    // test create gardener endpoint
    public function test_create_gardener_endpoint()
    {
        $response = $this->post('/api/register', ['fullname' => 'Sally Gardener',
            'email' => 'feature2@test.com',
            'password' => '!@#980gfhf',
            'location' => 'Lagos',
            'country' => 'Nigeria',
            'isCustomer' => false
        ]);

        $response->assertStatus(201);
    }


}



