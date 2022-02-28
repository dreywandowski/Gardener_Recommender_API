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
    public function test_a_basic_gardeners()
    {
        $response = $this->get('/api/gardeners');

        $response->assertStatus(200);
    }

}



