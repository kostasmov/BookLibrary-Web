<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static paginate(int $int)
 * @method static findOrFail(mixed $id)
 * @method static find(mixed $bookId)
 * @property integer $id
 * @property integer $amount
 */
class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'publisher',
        'book_year',
        'amount',
        'type',
        'cover'
    ];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_book');
    }
}
