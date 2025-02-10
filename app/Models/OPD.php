<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OPD extends Model
{
    use HasFactory;

    protected $table = 'opds';

    protected $fillable = ['name'];

    public function bidangs()
    {
        return $this->hasMany(Bidang::class);
    }

    public function wifis()
    {
        return $this->hasMany(Wifi::class);
    }
}
