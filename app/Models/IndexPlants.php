<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Mail\Mailables\Content;

class IndexPlants extends Model
{
    use HasFactory;
    protected $table = 'index_plants';
    protected $guarded = ['id'];
    public $timestamps = true;
    protected $fillable = [
        'name',
        'ordo',
        'divisi',
        'genus',
        'kelas',
        'kingdom',
        'species',
        'famili'
    ];
    public function plants()
    {
        return $this->hasMany(Plants::class, 'index_plant_id'); // Adjust the foreign key if necessary
    }
    public function content_plant(){
        return $this->hasMany(ContentPlants::class, 'id_index_plant');
    }
}
