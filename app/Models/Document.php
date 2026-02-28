<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = "documents";
    protected $fillable = [
        "from",
        "to",
        "subject",
        "description",
        "prioritization",
        "classification",
        "subclassification",
        "action",
        "deadline",
        "file",
    ];
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_user_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_user_id');
    }

        /**
         * Retrieve the model for a bound value.
         *
         * @param  mixed  $value
         * @param  string|null  $field
         * @return \Illuminate\Database\Eloquent\Model|null
         */
        public function resolveRouteBinding($value, $field = null)
        {
            $id = str_starts_with($value, '#') ? $value : "#{$value}";
            return $this->where('document_id', $id)->firstOrFail();
        }
    }
    