<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['image','name','unique_identifier'];
    //se oculta la imagen porque viene en otro formato
    protected $hidden = ['image'];
    
    public function article()
    {        
        return $this->belongsTo('App\Models\Article', 'article_id');
    }
    
}
