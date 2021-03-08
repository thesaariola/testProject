<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{   
    protected $fillable = ['username','comment','parent_id'];
       
	public function scopeIsParent($builder)
	{
		return $builder->whereNull('parent_id');
	}	
	
	public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id')->latest();
    }
	
}
