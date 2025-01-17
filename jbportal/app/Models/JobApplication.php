<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'user_id',
        'name',
        'email',
        'phone',
        'cover_letter',
        'resume',
        'status'
    ];

    const STATUS_APPLIED = 'applied';
    const STATUS_PENDING = 'pending';
    const STATUS_REJECTED = 'rejected';

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 