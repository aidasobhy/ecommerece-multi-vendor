<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Translatable;
    use HasFactory;

    protected $fillable=['slug'];

    protected $with =['translations'];

    protected $translatedAttributes =['name'];


}
