<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use refreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetToken()
    {
        $uri = 'api/v1/token?login=login&password=password';

        $response = $this->post($uri);

        $response->assertStatus(201);

        $this->assertDatabaseCount('tokens', 1);
    }


}
