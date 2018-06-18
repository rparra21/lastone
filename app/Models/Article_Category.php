<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article_Category extends Model
{
    
    //
    protected $table = 'articles_categories';

    protected $fillable = ['article_id','category_id'];


    /*
    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    */
}
