<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Reviews extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    protected $guarded = ['id'];
    public $timestamps = true;

    protected $fillable = [
        'name',
        'phone',
        'rating',
        'comment',
        'code_asset',
        'created_at'
    ];

    public function asset()
    {
        return $this->belongsTo(Assets::class, 'code_asset', 'code_asset');
    }

}
