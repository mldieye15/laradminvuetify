<?php

namespace App\Repositories\Params;

use App\Models\Params\GradePratiquant;

class GradePratiquantRepository {

    /**
     * @var App\Models\Params\GradePratiquant
    */
    protected $model;

    /**
     * GradePratiquantRepository constructor
     *
     * @param App\Models\Params\GradePratiquant $model
    */
    public function __construct(GradePratiquant $model){
        $this->model = $model;
    }

    /**
     * Retourne toutes les grapdes de spratiquants.
     *
     * @return App\Models\Params\GradePratiquant $model
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
     * Recupérer le grade selon l'age passé en paramétre
     *
     * @param $id
     * @return mixed
     */
    public function getGradeByAge($age)
    {
        return $this->model
            ->where('age_min', '>=', $age)
            ->where('age_max', '<', $age)
            ->first()
            //->get()
            ;
    }

    /**
     * Recupérer le grade selon le niveau passé en paramétre
     *
     * @param $id
     * @return mixed
     */
    public function onNext($niveau)
    {
        return $this->model
            ->where('niveau',  ($niveau+1))
            ->first()
            //->get()
            ;
    }

    /**
     * Recupérer le grade selon le niveau passé en paramétre
     *
     * @param $id
     * @return mixed
     */
    public function onPrevious($niveau)
    {
        return $this->model
            ->where('niveau',  ($niveau-1))
            ->first()
            //->get()
            ;
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
        $model->age_min = $data['age_min'];
        $model->age_max = $data['age_max'];
        $model->active = $data['active'];
        $model->niveau = $data['niveau'];

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
