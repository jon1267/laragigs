<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // по сути толково: в контроллере (см ListingController@index) в выборке данных
    // добавляется ->filter(request(['tag']))->get() + эта функция и есть фильтр тэгов.
    public function scopeFilter($query, array $filters)
    {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
    }
}
