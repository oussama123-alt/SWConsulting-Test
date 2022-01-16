<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
     /**
     * Display the specified resource.
     *
     * @param  Utilisateur $utilisateur
     * @return \Illuminate\Http\Response
     */
    public function details(Utilisateur $utilisateur){
        $groupes = $utilisateur->groupes->sortBy('nom');
        return view('utilisateurdetails', compact('utilisateur','groupes'));
    }
}
