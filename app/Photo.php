<?php declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Photo
 * @package App
 */
class Photo extends Model
{
    /** @var string[] */
    protected $guarded = ['id'];
}
