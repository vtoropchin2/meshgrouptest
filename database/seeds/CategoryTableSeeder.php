<?php declare(strict_types=1);

use Illuminate\Database\Seeder;
use App\Category;

/**
 * Class CategoryTableSeeder
 */
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rootCategories = factory(Category::class, 50)->create();

        foreach ($rootCategories as $category) {
            $category->categories()->save(factory(Category::class)->make());
            $categoryLevelOne = $category->categories()->save(factory(Category::class)->make());
            $categoryLevelOne->categories()->save(factory(Category::class)->make());
            $categoryLevelOne->categories()->save(factory(Category::class)->make());
        }
    }
}
