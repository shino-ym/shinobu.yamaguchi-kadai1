<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('ja_JP');

        $tel1 = $this->faker->numerify('0##');
        $tel2 = $this->faker->numerify('####');
        $tel3 = $this->faker->numerify('####');

        return [
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
            'last_name' => $this->faker->lastName,        // 姓
            'first_name' => $this->faker->firstName,      // 名
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->unique()->safeEmail,
            'tel1' => $tel1,
            'tel2' => $tel2,
            'tel3' => $tel3,
            'tel'  => $tel1 . $tel2 . $tel3, // 09012345678 形式
            'address' => $this->faker->address,
            'building' => $this->faker->secondaryAddress,
            'detail' => $faker->realText(10, 1)
        ];
    }
}
