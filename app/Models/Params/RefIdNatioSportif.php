<?php

namespace App\Models\Params;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefIdNatioSportif extends Model
{
    use HasFactory;

    protected $table = 'ref_id_natio_sportifs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prefixe',
        'compteur',
        'suffixe',
        'codification'
    ];

    /**
     * recupérer la série courante et l'incremente le compteur. Une série
     *
     * @var array<int, string>
     */
    public function scopeIncremnetCompteur() {
        //$currentRefIdNAtioSportif = RefIdNatioSportif::
        //$seriesBac = SeriesBac::orderBy('libelle', 'ASC')->where('visible',1)->get();
        //return DB::table('mainmenus')->where(['menu_type'=>'leftmenu', menu_publish'=>1])->orderBy('menu_sort', 'ASC')->get();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function scopeReduceCompteur() {
        //return DB::table('mainmenus')->where(['menu_type'=>'leftmenu', menu_publish'=>1])->orderBy('menu_sort', 'ASC')->get();
    }

    /**
     * Redemérre le compteur en 001.
     *
     * @var array<int, string>
     */
    public function scopeReinitializeCompteur() {

        //return DB::table('mainmenus')->where(['menu_type'=>'leftmenu', menu_publish'=>1])->orderBy('menu_sort', 'ASC')->get();
    }

    /**
     * Redemérre le compteur en 001.
     *
     * @var array<int, string>
     */
    public function scopeChangeFirstLettre() {

        //return DB::table('mainmenus')->where(['menu_type'=>'leftmenu', menu_publish'=>1])->orderBy('menu_sort', 'ASC')->get();
    }

    /**
     * Redemérre le compteur en 001.
     *
     * @var array<int, string>
     */
    public function scopeChangeSecondLettre() {

        //return DB::table('mainmenus')->where(['menu_type'=>'leftmenu', menu_publish'=>1])->orderBy('menu_sort', 'ASC')->get();
    }

    /**
     * Redemérre le compteur en 001.
     *
     * @var array<int, string>
     */
    public function scopeChangePrefixe() {

        //return DB::table('mainmenus')->where(['menu_type'=>'leftmenu', menu_publish'=>1])->orderBy('menu_sort', 'ASC')->get();
    }

    /**
     * Redemérre le compteur en 001.
     *
     * @var array<int, string>
     */
    public function scopeChangeSuffixe() {

        //return DB::table('mainmenus')->where(['menu_type'=>'leftmenu', menu_publish'=>1])->orderBy('menu_sort', 'ASC')->get();
    }
}
