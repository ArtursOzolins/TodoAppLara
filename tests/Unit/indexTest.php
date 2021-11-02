<?php

namespace Tests\Unit;

use http\Client\Curl\User;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class indexTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $user = \App\Models\User::factory()->create();
    }

}
