<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $student_id = $this->faker->numberBetween(810601, 810630);
//        return [
//            'student_id' => $student_id,
//            'name' => $this->faker->name(),
//            'email' => 'u'.$student_id.'@tcivs.tc.edu.tw',
//            'identity_id' => '1',
//            'class_id' => '8',
//            'password' => '$2y$10$uGrmPQX3Z2aedkQ44lRFOegZ7CW4qy/nzRK2xq6rmImU7SATXDgVO', // password 123
//        ];
        return [
            'student_id' => 810612,
            'name' => '王鈞霖',
            'email' => 'u810612@tcivs.tc.edu.tw',
            'identity_id' => '1',
            'class_id' => '8',
            'password' => '$2y$10$uGrmPQX3Z2aedkQ44lRFOegZ7CW4qy/nzRK2xq6rmImU7SATXDgVO', // password 123
        ];
    }

//    /**
//     * Indicate that the model's email address should be unverified.
//     *
//     * @return static
//     */
//    public function unverified()
//    {
//        return $this->state(function (array $attributes) {
//            return [
//                'email_verified_at' => null,
//            ];
//        });
//    }
}
