<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessVillages extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'access_villages';
    protected $guarded = ['id'];
    public $timestamps = true;
    protected $fillable = [
        'id_user',
        'id_village',
    ];
}
