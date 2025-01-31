<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
        // protected $guarded = [];
        protected $fillable =['title','description','slug','status','image','posted_by'];
}
