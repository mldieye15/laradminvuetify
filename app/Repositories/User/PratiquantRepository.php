<?php

namespace App\Repositories\User;

use App\Models\User\Pratiquant;

class PratiquantRepository {

    /**
     * @var App\Models\User\Pratiquant
    */
    protected $model;

    /**
     * PratiquantRepository constructor
     *
     * @param App\Models\User\Pratiquant $model
    */
    public function __construct(Pratiquant $model){
        $this->model = $model;
    }

    /**
     * Retourne tous les type de structures.
     *
     * @return App\Models\User\Pratiquant $model
     */
    public function getAll()
    {
        return $this->model
            ->get();
    }

    /**
     * Recupérer un type de structue par son id
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
     * Enregistrer un type de structure
     *
     * @param $data
     * @return App\Models\User\Pratiquant
     */
    public function add($data)
    {
        $model = new $this->model;
        //dd($data);
        $model->personne_id = $data['personne'];
        $model->fonction_pratiquant_id = $data['fonction'];
        $model->cote_pratiquant_id = $data['cote'];
        $model->ins = $data['ins'];

        $model->save();

        return $model->fresh();
    }

    /**
     * Metre à jour un type de structure
     *
     * @param $data
     * @param App\Models\User\Pratiquant $club
     * @return String
     */
    public function maj($data, $type)
    {
        $model = $type;

        $model->libelle = $data['libelle'];
        $model->sigle = $data['sigle'];
        $model->visible = $data['visible'];

        $model->update();

        return $model;
    }

    /**
     * Supprimer un club
     *
     * @param $id
     * @return App\Models\User\Pratiquant
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return $model;
    }
    
}
