<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'job';

    protected $fillable = [
        'title',
        'description',
        'company',
        'location',
        'salary',
        'salary_type',
        'job_type',
        'status',
        'user_id',
    ];

    protected $casts = [
        'salary' => 'decimal:2',
    ];

    const JOB_TYPES = [
        'full-time',
        'part-time',
        'contract',
        'freelance'
    ];

    const STATUSES = [
        'active',
        'inactive'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('job_type', $type);
    }
}