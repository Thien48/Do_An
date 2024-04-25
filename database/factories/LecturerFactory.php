<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Department;
use App\Models\Lecturer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lecturer>
 */
class LecturerFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  protected function getDegree()
  {
    return ['Tiến sĩ', 'Thạc Sĩ'];
  }

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
  public function definition()
  {
    $gender = $this->faker->randomElement([0, 1]);
    return [
      'msgv' => $this->faker->numberBetween(1000000000, 9999999999),
      'name' => $this->faker->name(),
      'telephone' => $this->generatePhoneNumber(),
      'degree' => $this->getDegree()[array_rand($this->getDegree())],
      'gender' => $this->faker->randomElement([0, 1]),
      'image' => $this->generateImage($gender),
      'user_id' => UserFactory::new()->create()->id,
      'department_id' => Department::inRandomOrder()->first()->id,
    ];
  }
}
