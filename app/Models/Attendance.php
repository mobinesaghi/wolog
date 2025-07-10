<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'user_identity',
        'latitude',
        'longitude',
        'latitude_exit',
        'longitude_exit',
        'ip_exit',
        'latitude_office',
        'longitude_office',
        'distance',
        'ip_address',
        'entered_at',
        'exited_at',
    ];

    public function setEntryLocationAttribute($value)
    {
        $this->attributes['entry_location'] = DB::raw("ST_SetSRID(ST_Point({$value['lng']}, {$value['lat']}), 4326)");
    }

    public function setExitLocationAttribute($value)
    {
        $this->attributes['exit_location'] = DB::raw("ST_SetSRID(ST_Point({$value['lng']}, {$value['lat']}), 4326)");
    }

    public function setOfficeLocationAttribute($value)
    {
        $this->attributes['office_location'] = DB::raw("ST_SetSRID(ST_Point({$value['lng']}, {$value['lat']}), 4326)");
    }

    public function breaks()
    {
        return $this->hasMany(AttendanceBreak::class);
    }
    public $timestamps = true;
}
