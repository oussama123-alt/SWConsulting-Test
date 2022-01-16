<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class GroupeController extends Controller
{

   public function importCSV(Request $request){

       if (($handle = fopen($request->csv, 'r')) !== false)
       {
           while (($row = fgetcsv($handle)) !== false)          //parse csv file row by row
           {
                if ($row[0] == 'U') {                           //if row has user
                  $user =  $this->StoreUser($row , ';');
                }
                elseif ($row[0] == 'G') {                       //if row has groupe
                    $this->StoreGroupe($row , ';');
                }
                else {
                    return redirect('/')->with('danger',' ficher incompléte ou non csv detecté ');
                }
           }
           fclose($handle);
        return redirect('/')->with('success',' ficher csv importé avec success');;

       }else {
            return redirect('/')->with('danger',' ficher non csv detecté');
       }
   }


    function StoreUser($row , $delimiter = ';')
    {
        /***check if groupe exist or create***/
        if (isset($row[3])) {
            $groupes = explode($delimiter,$row[3]);
            foreach ($groupes as $groupe) {
                if (!Groupe::find($groupe)) {
                   Groupe::create(['nom' => $groupe]);
                }
            }
        }

        /********if user already exist**********/
        if (($user = Utilisateur::find($row[1])) !== null) {
            $user->nom = $row[2];
            if (isset($groupes)) {
                $user->groupes()->syncWithoutDetaching($groupes);
            }
            $user->save();
        }
        /********if user doesn't exist**********/
        else {
            $user = Utilisateur::create([
                'email' => $row[1],
                'nom' => $row[2]
            ]);
            if (isset($groupes)) {
                $user->groupes()->syncWithoutDetaching($groupes);
            }
            $user->save();
        }
        return $user;
    }


    function StoreGroupe($row , $delimiter = ';')
    {
        /***check if groupe exist or create***/
        if (isset($row[2])) {
            $groupes = explode($delimiter,$row[2]);
            foreach ($groupes as $groupe) {
                if (!Groupe::find($groupe)) {
                   Groupe::create(['nom' => $groupe]);
                }
            }
        }

        /********if groupe already exist**********/
        if (($groupe = Groupe::find($row[1])) !== null) {
            if (isset($groupes)) {
                $groupe->parenteGroupes()->syncWithoutDetaching($groupes);
            }
            $groupe->save();
        }
        /********if user doesn't exist**********/
        else {
            $groupe = Groupe::create([
                'nom' => $row[1]
            ]);
            if (isset($groupes)) {
                $groupe->parenteGroupes()->syncWithoutDetaching($groupes);
            }
            $groupe->save();
        }
        return $groupe;
    }

    public function details(Groupe $groupe){
        $utilisteurs = $groupe->utilisateurs->sortBy('nom');
        return view('groupedetails', compact('utilisteurs','groupe'));
    }
}
