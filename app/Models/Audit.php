<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Audit extends Model
{
    protected $fillable = [
        'user_id',
        'ip',
        'device',
        'device_name',
        'platform',
        'platform_version',
        'browser',
        'browser_version',
        'agent',
        'logout',
    ];

    protected $hidden = [
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}