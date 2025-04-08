<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Assets extends Model
{
    use HasFactory;
    protected $table = 'assets';
    protected $guarded = ['id'];
    public $timestamps = true;

    protected $fillable = [
        'id_index_asset',
        'id_content_asset',
        'code_asset',
        'value',
        'large',
        'location',
        'date_open',
        'organizer',
        'address',
        'id_village',
        'age'
    ];
    public function IndexAsset()
    {
        return $this->hasOne(IndexAssets::class, 'id', 'id_index_asset'); // Sesuaikan nama field
    }

    public function ContentAsset()
    {
        return $this->hasOne(ContentAssets::class, 'id', 'id_content_asset'); // Sesuaikan nama field
    }

    public function Villages()
    {
        return $this->hasOne(Villages::class, 'id', 'id_villages'); // Sesuaikan nama field
    }
}
