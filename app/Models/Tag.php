<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $array)
 * @method static orderBy(string $string, string $string1)
 * @method static latest()
 * @method static where(string $string, string $string1, string $string2)
 */
class Tag extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tags';
    protected $guarded = [];

    public function repositories(): BelongsToMany
    {
        return $this->belongsToMany(Repository::class, 'repository_tag');
    }
}
