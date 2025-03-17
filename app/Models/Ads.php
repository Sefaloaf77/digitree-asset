<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ads extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'ads';
    protected $guarded = ['id'];
    public $timestamps = true;

    protected $fillable = [
        'id',
        'title',
        'image'
    ];
}
