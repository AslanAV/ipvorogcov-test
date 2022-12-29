<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithFaker;
use JsonException;
use Tests\TestCase;

class TokenTest extends TestCase
{
    use refreshDatabase;

    /**
     * @throws JsonException
     */
    public function testGetToken(): void
    {
        $uri = 'api/v1/token?login=login&password=password';

        $response = $this->post($uri);

        $response->assertStatus(201);

        $this->assertDatabaseCount('tokens', 1);

        $data = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertArrayHasKey('token', $data);
    }
}
