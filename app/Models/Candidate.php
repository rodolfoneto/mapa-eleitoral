<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['responsibility_id', 'name', 'political_party', 'main'];

    public function responsibility()
    {
        return $this->belongsTo(Responsibility::class);
    }
}
