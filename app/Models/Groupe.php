<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;

    protected $primaryKey = 'nom';
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    public $fillable = [ 'nom' ];

    public function utilisateurs()
    {
        return $this->belongsToMany(Utilisateur::class, 'utilisateurs_groupes')->withTimestamps();
    }

     /**
     * Every groupe can contain many related groupes . (groupeOne is a parent of groupeTwo)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subGroupes()
    {

        return $this->belongsToMany(Groupe::class, 'groupes_groupes', 'groupeOne_nom', 'groupetwo_nom');
    }

    /**
     * Every groupe can belongs to many related groupes (groupeOne is a subGroupe of groupeTwo).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function parenteGroupes()
    {
        return $this->belongsToMany(Groupe::class, 'groupes_groupes', 'groupetwo_nom', 'groupeOne_nom');
    }
}
