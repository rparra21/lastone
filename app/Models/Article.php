<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['image_id','url','title','snippet','pinned','start_date','expire_date','order'];

    public function image()
    {
        //el segundo parametro especifica cual es la foreign key
        return $this->hasOne('App\Models\Image');
    }
  
    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'articles_categories', 'article_id', 'category_id');
    }

  /*  public function getOrderAttribute($value)
    {
        $var = strtotime($value);
        
        return $var;
    }*/
}
