<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subclassification extends Model
{
    use HasFactory;
    protected $table = "subclassifications";

    protected $fillable = [
        'name',
        'classification_id',
    ];

    public function classification()
    {
        return $this->belongsTo(Classification::class);
    }
}
