<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'description', 'status_id', 'assigned_to_id', 'created_by_id'])]
class Task extends Model
{
    use HasFactory;

    public function status()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }

    public function scopeLabels($query, string|array $labels)
    {
        $ids = is_array($labels) ? $labels : [$labels];
        return $query->whereHas('labels', function ($q) use ($ids) {
            $q->whereIn('labels.id', $ids);
        });
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class);
    }
}
