<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Document;

class Patent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'inventor_name', 'category', 'filing_date', 'status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function documents() {
        return $this->morphMany(Document::class, 'documentable');
    }
}
