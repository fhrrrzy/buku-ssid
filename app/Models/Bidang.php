<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bidang extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'opd_id']; // Corrected to 'opd_id'

    public function opd()
    {
        return $this->belongsTo(OPD::class, 'opd_id'); // Corrected to 'opd_id'
    }

    public function wifis()
    {
        return $this->hasMany(Wifi::class);
    }
}
