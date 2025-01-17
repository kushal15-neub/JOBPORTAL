<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category_id',
        'job_type_id',
        'vacancy',
        'salary',
        'location',
        'description',
        'benefits',
        'responsibality',
        'qualification',
        'keywords',
        'experience',
        'company_name',
        'company_location',
        'company_website',
        'queue',
        'payload',
        'attempts',
        'reserved_at',
        'available_at',
        'isFeatured'
    ];

    protected $casts = [
        'isFeatured' => 'boolean',
        'reserved_at' => 'integer',
        'available_at' => 'integer',
        'attempts' => 'integer'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
