<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imageable_type = [1=>'App\Models\Todolist',2=>'App\Models\Comment'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.api-ninjas.com/v1/randomimage?category=nature',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'X-Api-Key: 0t22OCOwnyJFD7ny4j8UzQ==lQDK2c05ZyEySBt1'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return [
            'image_path' => $response,
            'imageable_type' => $imageable_type[rand(1,2)],
            'imageable_id' => rand(1,200),
        ];
    }
}
