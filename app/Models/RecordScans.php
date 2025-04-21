<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RecordScans extends Model
{
    use HasFactory;
    protected $table = 'record_scans';
    protected $guarded = ['id'];
    protected $fillable = [
        'scan_date',
        'code_asset',
        'ip_address',
        'location'
    ];
    public $timestamps = true;
}
