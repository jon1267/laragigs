<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'user_id','tags','company', 'location', 'email', 'website', 'description', 'logo'
    ];

    // по сути толково: в контроллере (см ListingController@index) в выборке данных
    // добавляется ->filter(request(['tag']))->get() + эта функция и есть фильтр тэгов.
    public function scopeFilter($query, array $filters)
    {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // Relation with User (там 'user_id' ненада, но можно :)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
