<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Villages extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'villages';
    protected $guarded = ['id'];
    public $timestamps = true;

    protected $fillable = [
        'name',
        'kecamatan',
        'kab_kota',
        'province',
    ];
}
