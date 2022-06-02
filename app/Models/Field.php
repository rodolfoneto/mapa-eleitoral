<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = ['group_field_id', 'type', 'uuid', 'placeholder'];

    public function groups()
    {
        return $this->belongsTo(GroupField::class);
    }
}
