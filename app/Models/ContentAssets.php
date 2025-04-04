<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContentAssets extends Model
{
    use HasFactory;
    protected $table = 'content_assets';
    protected $guarded = ['id'];
    public $timestamps = true;
    protected $fillable = [
        'id_index_asset',
        'history',
        'morfologi',
        'benefit',
        'fact',
        'image',
        'videos',
    ];

    public function content()
    {
        return $this->belongsTo(Assets::class);
    }

    public function index_asset()
    {
        return $this->belongsTo(IndexAssets::class);
    }


}
