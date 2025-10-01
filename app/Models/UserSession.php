<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSession extends Model
{
    protected $table = 'user_sessions';

    protected $fillable = [
        'userId',
        'userRole',
        'login_time',
        'logout_time',
    ];

    protected $casts = [
        'login_time' => 'datetime',
        'logout_time' => 'datetime',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'userId');
    }

    public function getDuracionAttribute()
    {
        if (!$this->logout_time) {
            return null;
        }
        return $this->login_time->diff($this->logout_time);
    }
}

