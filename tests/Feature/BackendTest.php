<?php

namespace Tests\Feature;

use App\Models\Data;
use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JsonException;
use Tests\TestCase;

//use Illuminate\Foundation\Testing\WithFaker;

class BackendTest extends TestCase
{
    use refreshDatabase;
    private Token $token;
    private Data $data;

    public function setUp(): void
    {
        parent::setUp();
        $carbon = new Carbon();
        $this->token = Token::factory()->create();
        $this->data = Data::factory()->create();
    }

    public function testBackendPage(): void
    {
        $response = $this->get(route('backend.index'));
        $response->assertOk();
    }

    public function testEditBackendPage(): void
    {
        $response = $this->get(route('backend.edit', $this->data->id));
        $response->assertOk();
    }

    public function testUpdateData(): void
    {
        $data = ['data' => '{}'];
        $response = $this->patch(route('backend.update', $this->data), $data);

        $response->assertRedirect(route('backend.index'));

        $this->assertDatabaseHas('data', $data);
    }

    public function testDeleteData(): void
    {
        $id = $this->data->toArray()['id'];
        $data = $this->data->toArray()['data'];

        $response = $this->delete(route('backend.destroy', $id));

        $response->assertRedirect(route('backend.index'));

        $this->assertDatabaseMissing('data', [$data]);
    }
}
