<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Null_;

class Task extends Model
{
    protected $fillable = [
        'title',
        'content',
        'completed_at',
        'recycled'
    ];

    protected $dates = [
        'completed_at'
    ];


    public function toggleStatus(): void
    {
        $this->completed_at = $this->completed_at == null ? now() : null;
    }

    public function toggleRecycle(): void
    {
        $this->recycled = $this->recycled == 'no' ? 'yes' : 'no';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;
}
