<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['menu_title','title','description','summary','external_link','publish_status','type_id','show_on',
        'parallex_img','featured_img','position','parent_id '];

    public function type()
    {
        return $this->belongsTo(ContentType::class,'type_id');
    }
}
