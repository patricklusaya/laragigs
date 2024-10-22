<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
  protected $fillable =['name', 'tags', 'company', 'location', 'description',  'email', 'logo','user_id'];

  public function scopeFilter($query, array $filters) {
    if($filters['tag'] ?? false) {
        $query->where('tags', 'like', '%' . request('tag') . '%');
    }

    if($filters['search'] ?? false) {
        $query->where('name', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%')
            ->orWhere('tags', 'like', '%' . request('search') . '%');
    }
}

  public function user (){
    return $this->belongsTo(User::class, 'user_id');
}
}
