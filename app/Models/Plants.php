<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Plants extends Model
{
    use HasFactory;
    protected $table = 'plants';
    protected $guarded = ['id'];
    public $timestamps = true;

    protected $fillable = [
        'id_index_plants',
        'id_content_plants',
        'code_plant',
        'tall',
        'round',
        'location',
        'date_plant',
        'source_fund',
        'qr_code',
        'address',
        'id_villages',
        'age'
    ];
    public function IndexPlant()
    {
        return $this->hasOne(IndexPlants::class, 'id', 'id_index_plants'); // Sesuaikan nama field
    }

    public function ContentPlant()
    {
        return $this->hasOne(ContentPlants::class, 'id', 'id_content_plants'); // Sesuaikan nama field
    }

    public function Villages()
    {
        return $this->hasOne(Villages::class, 'id', 'id_villages'); // Sesuaikan nama field
    }
}
