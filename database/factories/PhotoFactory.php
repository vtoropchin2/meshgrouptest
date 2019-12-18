<?php declare(strict_types=1);

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Photo;
use App\Services\PhotoService;
use Faker\Generator as Faker;
use Intervention\Image\ImageManagerStatic as Image;

$factory->define(Photo::class, function (Faker $faker) {
    $str = $faker->text(12);
    $image = Identicon::getImageData($str, 300);
    $img = Image::make($image);

    $fileName = md5($str) . '.jpg';

    $img->save(PhotoService::getPhotoPath($fileName));

    return [
        'file_name' => $fileName,
    ];
});
