<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Token>
 */
class DataFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'data' => '{"common": {"setting1": "Value 1", "setting2": 200, "setting3": true, "setting6":
                { "key": "value", "doge": { "wow": ""}}},"group1": {"baz": "bas","foo": "bar", "nest": {"key":
                "value"}},"group2": {"abc": 12345, "deep": {"id": 45}}}',
            'token_id' => 1,
            'script_time' =>  0.02515131,
            'script_memory' =>  222555,
        ];
    }
}
