<?php

namespace App\Traits;

use App\Models\Params\RefIdNatioSportif;
use Illuminate\Support\Facades\DB;

trait RefGenerator
{

    /**
     *  initialise la série par 000.AA et 0 comme codification initiale Une série
     * @param string|null $table
     * @return void
    */
    public function initRefIdNatioSportif($table = 'ref_id_natio_sportifs') {
        DB::table($table)->insert([
            'suffixe'=>'AA', 'current' =>1
        ]);
    }

    /**
     *  initialise la série par AA.000.AA et 16 comme codification initiale Une série
     * @param string|null $table
     * @param string $suffixe
     * @param integer $current
     * @param integer $codification
     * @return void
    */
    public function addRefIdNatioSportif($suffixe, $codification, $current=1, $table = 'ref_id_natio_sportifs') {
        DB::table($table)->insert([
            'suffixe'=>$suffixe, 'codification'=>$codification, 'current'=>$current
        ]);
    }

    /**
     *  recupére le nombre de zéro
     * @return string
    */
    public function getNbreZero($compteur) {
        $maxNombre = config('constants.max_compteur_ref_id_natio_sportif');
        $difTaille = ( strlen($maxNombre) - strlen($compteur) >= 0) ? ( strlen($maxNombre) - strlen($compteur) ) : 0;
        $result = '';
        if($difTaille ===0){
            return $result;
        } else{
            for ($i = 0; $i < $difTaille; $i++){
                $result = $result.'0';
            }
        }
        return $result;
    }

    /**
     *  retourne
     * @return string
    */
    public function getNatioSportifId() {
        $compteur = $this->incrementCompteur();
        $currentCompteur = $this->getCurrentRefSerie();
        return $this->getNbreZero($compteur).$currentCompteur->compteur.$currentCompteur->suffixe;
        /*if($currentCompteur->compteur < 9){
            return '00'.$currentCompteur->compteur.$currentCompteur->suffixe;
        } elseif($currentCompteur->compteur > 9 && $currentCompteur->compteur < 99){
            return '0'.$currentCompteur->compteur.$currentCompteur->suffixe;;
        } else{
            return $currentCompteur->compteur.$currentCompteur->suffixe;;
        }*/
    }

    /**
     *  recupérer la série courante et incremente le compteur.
     * @return App\Models\Params\RefIdNatioSportif $currentSerie
    */
    public function closeCurrentSerie($currentSerie) {
        $currentSerie->current = 0;
        $currentSerie->save();
    }

    /**
     *  recupére la série en cours avec comme current=1
     * @return App\Models\Params\RefIdNatioSportif
    */
    public function getCurrentRefSerie() {
        return RefIdNatioSportif::where(['current'=>1])->first();
    }

    /**
     *  recupérer la série courante et incremente le compteur.
     * @return void
    */
    public function incrementCompteur() {
        $currentCompteur = $this->getCurrentRefSerie();
        // vérifie si le compteur est inférieur à 999
        if($currentCompteur->compteur >=0 && $currentCompteur->compteur < config('constants.max_compteur_ref_id_natio_sportif')){
            $currentCompteur->compteur =  $currentCompteur->compteur+1;
            $currentCompteur->save();
            return $currentCompteur->compteur;
        } else{
            $this->initialiseClasse($currentCompteur);
        }

        // DB::table('subject_user')->where('user_id', $value)->update(['auth_teacher' => 1]);
        //return DB::table('mainmenus')->where(['menu_type'=>'leftmenu', menu_publish'=>1])->orderBy('menu_sort', 'ASC')->get();
    }

    /**
     *  recommence le suffixe(classe) vers la prochaine comme 999AZ => AA001BA.
     * @param App\Models\Params\RefIdNatioSportif $currentSerie
     * @return void
    */
    public function initialiseClasse($currentSerie) {
        $classe = $currentSerie->suffixe;
        if(strtoupper($classe) !== strtoupper(config('constants.max_2_lettres'))){
            $output = str_split($classe);
            $currentFirst = strtoupper($output[0]);
            $currentLast = strtoupper($output[0]);

            $result="";
            if(strtoupper($output[1]) === 'Z'){
                $nextFirst = config('constants.lettres')[$currentFirst]['next'];
                $result = ($nextFirst)."A";

                $this->closeCurrentSerie($currentSerie);
                $this->addRefIdNatioSportif($result , ($currentSerie->codification+1));
            }else{
                $currentLast = strtoupper($output[0]);
                $nextLast = config('constants.lettres')[$currentLast]['next'];
                $result = $currentFirst.$nextLast;

                $this->closeCurrentSerie($currentSerie);
                $this->addRefIdNatioSportif($result, ($currentSerie->codification+1));
            }
            $this->incrementCompteur();
        } else{
            return "OA";
        }
    }

    /**
     *  recommence le suffixe(classe) vers la prochaine comme 999AZ => AA001BA.
     * @param string $classe
     * @return string
    */
    public function initialiseClasseAnc($classe) {
        if(strtoupper($classe) !== strtoupper(config('constants.max_2_lettres'))){
            $output = str_split($classe);
            if(strtoupper($output[1]) !== 'Z'){
                return 'continue';
            }
            $currentFirst = strtoupper($output[0]);
            $nextFirst =config('constants.lettres')[$currentFirst]['next'];
            $nextFirst= ($nextFirst)."A";
            return ($nextFirst);
            //return ($nextFirst)."A";
        } else{
            return "OA";
        }
    }

}
