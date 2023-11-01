<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stores>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->unique()->name,
            'code'=>$this->faker->unique()->name,
            'symbol'=>'none',
            'email' => $this->faker->unique()->safeEmail,
            'tagline'=>$this->faker->name,
            'description'=>$this->faker->text,
            'contact'=>$this->faker->name,
            'contact_type'=>'other',
            'cover' => $this->faker->imageUrl($width = 640, $height = 480),
            'logo' => $this->faker->imageUrl($width = 1000, $height = 600),
            'status'=>'inactive',
            'address1' => $this->faker->streetAddress,
            'address2' => $this->faker->secondaryAddress,
            'city'=>$this->faker->city,
            'state'=>$this->faker->state,
            'postal_code'=>'4400',
            'country'=>$this->faker->country,
            'shipping'=>'200',
            'tax'=>'200',
            'user_id' => User::factory(),
        ];
    }
}
