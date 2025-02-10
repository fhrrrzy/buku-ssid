<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wifi extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'brand',
        'type',
        'serial_number',
        'mac_address',
        'ssid',
        'password',
        'user_router',
        'password_router',
        'description',
        'opd_id',
        'bidang_id',
        'photos',
    ];

    protected $casts = [
        'photos' => 'array',
    ];

    public function opd()
    {
        return $this->belongsTo(OPD::class);
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'brand',
                'type',
                'serial_number',
                'mac_address',
                'ssid',
                'password',
                'user_router',
                'password_router',
                'description',
                'opd_id',
                'bidang_id',
            ]);
    }
}
