<?php

namespace App\Repositories\Federation;

use App\Models\Federation\LigueRegionale;

class LigueRegionaleRepository {

    /**
     * @var LigueRegionale
    */
    protected $model;

    /**
     * LigueRegionaleRepository constructor
     *
     * @param LigueRegionale $model
    */
    public function __construct(LigueRegionale $model){
        $this->model = $model;
    }

    /**
     * Retourne tous les ligues régionales.
     *
     * @return LigueRegionale $model
     */
    public function getAll()
    {
        return $this->model
            ->get();
    }

    /**
     * Recupérer un ligue regional par son id
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
     * @return LigueRegionale
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
     * Metre à jour un ligue régional
     *
     * @param $data
     * @return LigueRegionale
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
     * Supprimer un ligue régional
     *
     * @param $data
     * @return LigueRegionale
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return $model;
    }

}
