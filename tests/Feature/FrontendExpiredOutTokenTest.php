<?php

namespace Tests\Feature;

use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JsonException;
use Tests\TestCase;

//use Illuminate\Foundation\Testing\WithFaker;

class FrontendExpiredOutTokenTest extends TestCase
{
    use refreshDatabase;
    private Token $expireOutToken;
    private array $body;

    public function setUp(): void
    {
        parent::setUp();
        $carbon = new Carbon();
        $this->expireOutToken = Token::factory()->create([
            'login' => fake()->name(),
            'password'=> fake()->password(),
            'token' => md5(microtime() . 'ipvorogcov-test' . time()),
            'expires_at' => $carbon->subMinutes(6),
        ]);
        $this->body = ['{
          "common": {
            "setting1": "Value 1",
            "setting2": 200,
            "setting3": true,
            "setting6": {
              "key": "value",
              "doge": {
                "wow": ""
              }
            }
          },
          "group1": {
            "baz": "bas",
            "foo": "bar",
            "nest": {
              "key": "value"
            }
          },
          "group2": {
            "abc": 12345,
            "deep": {
              "id": 45
            }
          }
        }'];
    }

    public function testExpiredOutToken(): void
    {
        $token = $this->expireOutToken::value('token');

        $uri = 'api/v1/save-data';

        $response = $this->postJson($uri, $this->body, ['Authorization' => $token]);

        $response->assertStatus(403);
    }
}
