<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 'expert_id', 'scheduled_at', 'notes', 'status'
    ];

    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function expert() {
        return $this->belongsTo(User::class, 'expert_id');
    }
}
