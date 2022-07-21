<?php

namespace App\Repositories\Structures;

use App\Models\Structures\TypeStructure;

class TypeStructureRepository {

    /**
     * @var App\Models\Structures\TypeStructure
    */
    protected $model;

    /**
     * ClubRepository constructor
     *
     * @param App\Models\Structures\TypeStructure $model
    */
    public function __construct(TypeStructure $model){
        $this->model = $model;
    }

    /**
     * Retourne tous les type de structures.
     *
     * @return App\Models\Structures\TypeStructure $model
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
     * @return App\Models\Structures\TypeStructure
     */
    public function add($data)
    {
        $model = new $this->model;

        $model->libelle = $data['libelle'];
        $model->sigle = $data['sigle'];
        $model->visible = $data['visible'];

        $model->save();

        return $model->fresh();
    }

    /**
     * Metre à jour un type de structure
     *
     * @param $data
     * @param App\Models\Structures\TypeStructure $club
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
     * @return App\Models\Structures\TypeStructure
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return $model;
    }
    
}
