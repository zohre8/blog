<?php

namespace Tests\Feature;

use App\Services\Calculator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class calculatorTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_add_two_numbers_returns_correct_sum() :void
    {
        $calculator=new Calculator();
        $resalt = $calculator->add(5,7);
        $this->assertEquals(12,$resalt);
    }
}
