<?php

namespace Tests\Feature;

use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JsonException;
use Tests\TestCase;

//use Illuminate\Foundation\Testing\WithFaker;

class FrontendTest extends TestCase
{
    use refreshDatabase;
    private Token $token;
    private array $body;

    public function setUp(): void
    {
        parent::setUp();
        $this->token = Token::factory()->create();
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

    /**
     * @throws JsonException
     */
    public function testGetIdAndSaveData(): void
    {
        $token = $this->token::value('token');

        $uri = 'api/v1/save-data';

        $response = $this->postJson($uri, $this->body, ['Authorization' => $token]);

        $response->assertStatus(201);

        $this->assertDatabaseCount('data', 1);

        $data = json_decode($response->getContent(), true, 512, JSON_THROW_ON_ERROR);

        $this->assertArrayHasKey('id', $data);
        $this->assertArrayHasKey('scriptTime', $data);
        $this->assertArrayHasKey('scriptMemory', $data);
    }

    public function testBadToken()
    {
        $token = 'ce404f1d3da79074259d818d501262cb';

        $uri = 'api/v1/save-data';

        $response = $this->postJson($uri, $this->body, ['Authorization' => $token]);

        $response->assertStatus(403);
    }
}
