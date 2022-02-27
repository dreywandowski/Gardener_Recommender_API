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
# Test function for Box class
    public
    function testBoxContents()
    {
        $box = new Box(['toy']);
        $this->assertTrue($box->has('toy'));
        $this->assertFalse($box->has('ball'));
    }

    public function testInput()
    {
        UserController::assertEquals('Customer', testUserInput($cust));

    }

    public function testStartsWithALetter()
    {
        $box = new Box(['toy', 'torch', 'ball', 'cat', 'tissue']);

        $results = $box->startsWith('t');

        $this->assertCount(3, $results);
        $this->assertContains('toy', $results);
        $this->assertContains('torch', $results);
        $this->assertContains('tissue', $results);

        // Empty array if passed even
        $this->assertEmpty($box->startsWith('s'));
    }


}



