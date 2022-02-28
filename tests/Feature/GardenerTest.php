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

    // test create gardener endpoint - 201 OK
    public function test_create_gardener_created_endpoint()
    {
        $response = $this->post('/api/register', ['fullname' => 'Sally Gardener',
            'email' => 'feature2@test.com',
            'password' => '!@#980gff33',
            'location' => 'Nairobi',
            'country' => 'Kenya',
            'isCustomer' => false
        ]);

        $response->assertStatus(201);
    }

    // test create gardener endpoint -- 400 Failed
    public function test_create_gardener_failed_endpoint()
    {
        $response = $this->post('/api/register', ['fullname' => 'Sally Gardener',
             'email' => 'feature2@test.com',
            'password' => '!@#980gff33',
            'location' => 'Nairobi',
            'country' => 'Kenya',
            'isCustomer' => false
        ]);

        $response->assertStatus(400);
    }

    // test create customer endpoint -- 201 OK
    public function test_create_customer_created_endpoint()
    {
        $response = $this->post('/api/register', ['fullname' => 'Sally Customer',
                                                      'email' => 'feature@test.com',
                                                      'password' => '!@#980gfhf',
                                                      'location' => 'Lagos',
                                                      'country' => 'Nigeria',
                                                       'isCustomer' => true
                                                           ]);
        $this->assertJson([
            'fullname' => ['The name field is required.'],
            'email' => ['The email field is required.'],
            'password' => ['The password field is required.'],
            'location' => ['The location field is required.'],
            'country' => ['The country field is required.'],
            'isCustomer' => ['the isCustomer field is required'],
        ]);


        $response->assertStatus(201);
    }

    // test create customer endpoint -- 400 failed
    public function test_create_customer_failed_endpoint()
    {
        $response = $this->post('/api/register', ['fullname' => 'Sally Customer',
            'email' => 'feature@test.com',
            'password' => '!@#980gfhf',
            'location' => 'Lagos',
            'country' => 'Nigeria',
            'isCustomer' => true
        ]);

        $response->assertStatus(400);
    }





}



