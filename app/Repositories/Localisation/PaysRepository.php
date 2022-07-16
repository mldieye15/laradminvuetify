<?php

namespace App\Repositories\Localisation;

use App\Models\Localisation\Pays;

class PaysRepository {

    /**
     * @var App\Models\Localisation\Pays
    */
    protected $model;

    /**
     * PaysRepository constructor
     *
     * @param App\Models\Localisation\Pays $model
    */
    public function __construct(Pays $model){
        $this->model = $model;
    }

    /**
     * Retourne tous les pays.
     *
     * @return App\Models\Localisation\Pays $model
     */
    public function getAll()
    {
        return $this->model
            ->get();
    }

    /**
     * Retourne tous les pays avec le minimum d'inforamtion.
     *
     * @return App\Models\Localisation\Pays $model
     */
    public function minimalPays(){
        return $this->model
            ->get(['id','libelle','sigle']);
    }

    /**
     * Recupérer un pays par son id
     *
     * @param $id
     * @return mixed
     */
    public function getCurrentPays()
    {
        return $this->model
            ->select('id','libelle','sigle')
            ->where('current', 1)
            ->get();
    }
    /**
     * Recupérer un pays par son id
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
     * Enregistrer un pays
     *
     * @param $data
     * @param $logo
     * @param $ligue
     * @return App\Models\Localisation\Pays
     */
    public function add($data, $logo, $ligue)
    {
        $model = new $this->model;

        $model->libelle = $data['libelle'];
        $model->sigle = $data['sigle'];
        $model->logo = $logo;
        $model->ligue_regionale_id = $ligue;

        $model->save();

        return $model->fresh();
    }

    /**
     * Metre à jour une association
     *
     * @param $data
     * @param App\Models\Localisation\Pays $pays
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

        $model->update();

        return $model;
    }

    /**
     * Supprimer un pays
     *
     * @param $id
     * @return App\Models\Localisation\Pays
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return $model;
    }

}
