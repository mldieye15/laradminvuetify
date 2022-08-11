<?php

namespace App\Repositories\User;

use App\Models\User\Demande;

class DemandeRepository {

    /**
     * @var App\Models\User\Demande
    */
    protected $model;

    /**
     * DemandeRepository constructor
     *
     * @param App\Models\User\Demande $model
    */
    public function __construct(Demande $model){
        $this->model = $model;
    }

    /**
     * Retourne toutes les demandes.
     *
     * @return App\Models\User\Demande $model
     */
    public function getAll()
    {
        return $this->model
            ->get();
    }

    /**
     * Recupérer une demande par son id
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
     * Enregistrer une demande
     *
     * @param $data
     * @return App\Models\User\Demande
     */
    public function add($data)
    {
        $model = new $this->model;
        //dd($data);
        $model->personne_id = $data['personne'];
        $model->type_demande_id = $data['typedemande'];
        $model->fonction_pratiquant_id = $data['fonction'];
        $model->cote_pratiquant_id = $data['cote'];
        $model->type_structure_id = $data['typestructure'];
        $model->structure = $data['structure'];

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
