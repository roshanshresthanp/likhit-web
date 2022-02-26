<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    // protected $table = 'settings';
    protected $fillable = [
        'name','email','title','description','map','contact','phone','logo','gmail','favicon',
        'address','facebook','instagram','linkedIn','twitter','youtube','viber'
    ];
}
