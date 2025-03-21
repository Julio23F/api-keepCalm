<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'nombreEmployes'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function plats()
    {
        return $this->hasMany(Plat::class);
    }

}
