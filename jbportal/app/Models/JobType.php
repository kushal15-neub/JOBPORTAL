<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    use HasFactory;

    // If your table name is different from the default (plural of the model), specify it
    // protected $table = 'job_types';

    // Define fillable fields to allow mass assignment
    protected $fillable = ['name', 'description'];

    /**
     * The jobs that belong to the job type.
     */
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
