<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected function generatePhoneNumber()
    {
        return '0' .
            implode('', array_map(function ($n) {
                return rand(0, 9);
            }, str_split(str_repeat('0', 9))));
    }
    protected $images = [
        1 => 'user8-128x128.jpg',
        0 => 'user4-128x128.jpg'
    ];
    protected function generateImage($gender)
    {
        $image = $gender ? 'user8-128x128.jpg' : 'user4-128x128.jpg';
        return  $image;
    }
    protected function getClass()
    {
        return ['62-CNTT3', '62-CNTT1', '62-CNTT2', '62-CNTT4'];
    }
    public function definition(): array
    {
        $gender = $this->faker->randomElement([0, 1]);
        return [
            'mssv' => $this->faker->numberBetween(1000000000, 9999999999),
            'name' => $this->faker->name(),
            'class' => $this->getClass()[array_rand($this->getClass())],
            'gender' => $this->faker->randomElement([0, 1]),
            'telephone' => $this->generatePhoneNumber(),
            'image' => $this->generateImage($gender),
            'user_id' => UserFactory::new()->create()->id,
        ];
    }
}
