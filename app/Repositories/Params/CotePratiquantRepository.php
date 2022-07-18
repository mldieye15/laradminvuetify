<?php

namespace App\Repositories\Params;

use App\Models\Params\CotePratiquant;

class CotePratiquantRepository {

    /**
     * @var App\Models\Params\CotePratiquant
    */
    protected $model;

    /**
     * CotePratiquantRepository constructor
     *
     * @param App\Models\Params\CotePratiquant $model
    */
    public function __construct(CotePratiquant $model){
        $this->model = $model;
    }

    /**
     * Retourne toutes les cotés de spratiquants.
     *
     * @return App\Models\Params\CotePratiquant $model
     */
    public function getAll()
    {
        return $this->model
            ->get();
    }

    /**
     * Recupérer une grade  par son id
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
     * Enregistrer une grade
     *
     * @return App\Models\Params\CotePratiquant
     */
    public function add($data)
    {
        $model = new $this->model;

        $model->libelle = $data['libelle'];
        $model->sigle = $data['sigle'];
        $model->active = $data['active'];

        $model->save();

        return $model->fresh();
    }

    /**
     * Metre à jour une association
     *
     * @param $data
     * @param App\Models\Params\CotePratiquant $club
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
     * Supprimer un grade
     *
     * @param $id
     * @return App\Models\Params\GradePratiquant
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return $model;
    }

}
