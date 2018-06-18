<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = ['category','description','color'];
    
/*
    public function category()
    {
        return $this->hasMany('App\Models\Article_Category','category_id');
    }
*/
    public function articles()
    {
        return $this->belongsToMany('App\Model\Article');
    }

}
