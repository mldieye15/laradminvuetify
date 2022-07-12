<?php

namespace App\Repositories\Structures;

use App\Models\Structures\CentreFormation;

class CentreFormationRepository {

    /**
     * @var App\Models\Structures\Club
    */
    protected $model;

    /**
     * CentreFormationRepository constructor
     *
     * @param App\Models\Structures\CentreFormation $model
    */
    public function __construct(CentreFormation $model){
        $this->model = $model;
    }

    /**
     * Retourne tous les centres de formation.
     *
     * @return App\Models\Structures\CentreFormation $model
     */
    public function getAll()
    {
        return $this->model
            ->get();
    }

    /**
     * Recupérer un centrede foramtion par son id
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
     * Enregistrer un centre de formation
     *
     * @param $data
     * @param $logo
     * @param $ligue
     * @return App\Models\Structures\CentreFormation
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
     * Metre à jour un centre de formation
     *
     * @param $data
     * @param App\Models\Structures\CentreFormation $club
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
     * Supprimer un cnetre de formation
     *
     * @param $id
     * @return App\Models\Structures\CentreFormation
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return $model;
    }

}
