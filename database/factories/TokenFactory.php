<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Token>
 */
class TokenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $carbon = new Carbon();
        return [
            'login' => fake()->name(),
            'password'=> fake()->password(),
            'token' => md5(microtime() . 'ipvorogcov-test' . time()),
            'expires_at' => $carbon->addMinutes(5),
        ];
    }
}
