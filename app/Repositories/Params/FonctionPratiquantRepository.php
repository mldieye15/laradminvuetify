<?php

namespace App\Repositories\Params;

use App\Models\Params\FonctionPratiquant;

class FonctionPratiquantRepository {

    /**
     * @var App\Models\Params\GradePratiquant
    */
    protected $model;

    /**
     * FonctionPratiquantRepository constructor
     *
     * @param App\Models\Params\FonctionPratiquant $model
    */
    public function __construct(FonctionPratiquant $model){
        $this->model = $model;
    }

    /**
     * Retourne toutes les grapdes de spratiquants.
     *
     * @return App\Models\Params\FonctionPratiquant $model
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
     * @return App\Models\Params\GradePratiquant
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
     * @param App\Models\Params\GradePratiquant $club
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
