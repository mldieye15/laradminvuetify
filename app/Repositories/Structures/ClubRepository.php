<?php

namespace App\Repositories\Structures;
use App\Models\Structures\Club;

class ClubRepository {

    /**
     * @var App\Models\Structures\Club
    */
    protected $model;

    /**
     * ClubRepository constructor
     *
     * @param App\Models\Structures\Club $model
    */
    public function __construct(Club $model){
        $this->model = $model;
    }

    /**
     * Retourne tous les clubs.
     *
     * @return App\Models\Structures\Club $model
     */
    public function getAll()
    {
        return $this->model
            ->get();
    }

    /**
     * Recupérer un club par son id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model
            ->where('id', $id)
            ->get();
    }

    /**
     * Enregistrer un ligue régional
     *
     * @param $data
     * @param $logo
     * @param $ligue
     * @return App\Models\Structures\Club
     */
    public function add($data, $logo, $ligue)
    {
        $model = new $this->model;

        $model->libelle = $data['libelle'];
        $model->sigle = $data['sigle'];
        $model->adresse = $data['adresse'];
        $model->telephone = $data['telephone'];
        $model->email = $data['email'];
        $model->date_creation = $data['date_creation'];
        $model->page_web = $data['page_web'];
        $model->instagram = $data['instagram'];
        $model->page_web = $data['page_web'];
        $model->logo = $logo;
        $model->ligue_regionale_id = $ligue;

        $model->save();

        return $model->fresh();
    }

    /**
     * Metre à jour un club
     *
     * @param $data
     * @param App\Models\Structures\Club $club
     * @param $logo
     * @param $ligue
     * @return String
     */
    public function maj($data, $club, $logo, $ligue)
    {
        $model = $club;

        $model->libelle = $data['libelle'];
        $model->sigle = $data['sigle'];
        $model->adresse = $data['adresse'];
        $model->telephone = $data['telephone'];
        $model->email = $data['email'];
        $model->date_creation = $data['date_creation'];
        $model->page_web = $data['page_web'];
        $model->instagram = $data['instagram'];
        $model->page_web = $data['page_web'];
        $model->logo = $logo;
        $model->ligue_regionale_id = $ligue;
        $model->type_structure_id = 2;

        $model->update();

        return $model;
    }

    /**
     * Supprimer un club
     *
     * @param $id
     * @return App\Models\Structures\Club
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return $model;
    }

    /**
     * Retourne tous les clubs avec le minimum d'inforamtion.
     *
     * @return App\Models\Structures\Club $model
     */
    public function minimalClub(){
        return $this->model
            ->get(['id','libelle','sigle']);
    }
    
}
