<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes; 

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

        public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    
      // Booted method for cascading soft delete & restore
    protected static function booted()
    {
        // When a project is deleted
        static::deleting(function ($project) {
            if ($project->isForceDeleting()) {
                // Permanently delete tasks if project is permanently deleted
                $project->tasks()->forceDelete();
            } else {
                // Soft delete tasks when project is soft deleted
                $project->tasks()->delete();
            }
        });

        // When a project is restored
        static::restoring(function ($project) {
            // Restore all soft-deleted tasks
            $project->tasks()->withTrashed()->restore();
        });
    }
}

