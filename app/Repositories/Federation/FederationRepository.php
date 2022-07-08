<?php

namespace App\Repositories\Federation;

use App\Models\Federation\Federation;

class FederationRepository {

    /**
     * @var Federation
    */
    protected $model;

    /**
     * FederationRepository constructor
     *
     * @param Federation $model
    */
    public function __construct(Federation $model){
        $this->model = $model;
    }

    /**
     * Retourne toutes les fédérations.
     *
     * @return Federation $model
     */
    public function getAll()
    {
        return $this->model
            ->get();
    }

    /**
     * Retourne la fédération activée dans la base de données.
     *
     * @return Federation $model
     */
    public function getFederation()
    {
        return $this->model
            ->where('visible', 1)
            ->get();
    }

    /**
     * Retourne la fédération activée dans la base de données.
     *
     * @return Federation $model
     */
    public function simplifiedFede()
    {
        return $this->model
            ->select('id','libelle')
            ->where('visible', 1)
            ->get();
    }

    /**
     * Recupérer une fédération par son id
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
     * Enregistrer une fédération
     *
     * @param $data
     * @return Federation
     */
    public function save($data)
    {
        $model = new $this->model;

        $model->title = $data['title'];
        $model->description = $data['description'];

        $model->save();

        return $model->fresh();
    }

    /**
     * Metre à jour une fédération
     *
     * @param $data
     * @return Federation
     */
    public function update($data, $id)
    {
        $model = $this->model->find($id);

        $model->title = $data['title'];
        $model->description = $data['description'];

        $model->update();

        return $model;
    }

    /**
     * Supprimer une fédération
     *
     * @param $data
     * @return Federation
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return $model;
    }

}
