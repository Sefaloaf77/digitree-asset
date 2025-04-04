<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailables\Content;

class IndexAssets extends Model
{
    use HasFactory;
    protected $table = 'index_assets';
    protected $guarded = ['id'];
    public $timestamps = true;
    protected $fillable = [
        'nama_lokal',
        'jenis_aset',
    ];
    public function assets()
    {
        return $this->hasMany(Plants::class, 'index_asset_id');
    }
    public function content_asset()
    {
        return $this->hasMany(ContentPlants::class, 'id_index_asset');
    }
}
