<?php declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\Collection;
use Kalnoy\Nestedset\NodeTrait;

/**
 * Class Category
 * @method static Collection ancestorsAndSelf($id, array $columns = [ '*' ])
 *
 * @package App
 */
class Category extends Model
{
    use NodeTrait;

    /** @var string[] */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }
}
