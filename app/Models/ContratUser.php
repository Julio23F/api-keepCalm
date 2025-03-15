<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratUser extends Model
{
    use HasFactory;


    protected $fillable = ['contrat_type_id', 'user_id', 'frequence'];

    protected $casts = [
        'frequence' => 'array',
    ];

    public function contratType()
    {
        return $this->belongsTo(ContratType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
