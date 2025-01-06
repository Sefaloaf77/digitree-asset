<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ContentPlants extends Model
{
    use HasFactory;
    protected $table = 'content_plants';
    protected $guarded = ['id'];
    public $timestamps = true;
    protected $fillable = [
        'id_index_plant',
        'history',
        'morfologi',
        'benefit',
        'fact',
        'image',
        'videos',
    ];

    public function content()
    {
        return $this->belongsTo(Plants::class);
    }

    public function index_plant(){
        return $this->belongsTo(IndexPlants::class);
    }


}
