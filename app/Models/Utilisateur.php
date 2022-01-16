<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    use HasFactory;
    protected $primaryKey = 'email';
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    public $fillable = ['email', 'nom' ];

    public function groupes()
    {
        return $this->belongsToMany(Groupe::class, 'utilisateurs_groupes', 'utilisateur_email','groupe_nom')->withTimestamps();
    }
}
