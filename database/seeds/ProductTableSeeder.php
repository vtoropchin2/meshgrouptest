<?php declare(strict_types=1);

use Illuminate\Database\Seeder;
use App\Product;
use App\Category;
use App\Photo;

/**
 * Class ProductTableSeeder
 */
class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            factory(Product::class, random_int(1, 5))->create(
                [
                    'category_id' => $category->id,
                    'photo_id'    => factory(Photo::class),
                ]
            );
        }
    }
}
