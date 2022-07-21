<?php

namespace App\Repositories\Structures;

use App\Models\Structures\Association;

class AssociationRepository {

    /**
     * @var App\Models\Structures\Club
    */
    protected $model;

    /**
     * AssociationRepository constructor
     *
     * @param App\Models\Structures\Association $model
    */
    public function __construct(Association $model){
        $this->model = $model;
    }

    /**
     * Retourne toutes les associations.
     *
     * @return App\Models\Structures\Club $model
     */
    public function getAll()
    {
        return $this->model
            ->get();
    }

    /**
     * Recupérer une association  par son id
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
     * Enregistrer une assocaition
     *
     * @param $data
     * @param $logo
     * @param $ligue
     * @return App\Models\Structures\Association
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
     * Metre à jour une association
     *
     * @param $data
     * @param App\Models\Structures\Association $club
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
        $model->type_structure_id = 4;  //   valeur fixée par défaut à ne pas changer

        $model->update();

        return $model;
    }

    /**
     * Supprimer une assocaition
     *
     * @param $id
     * @return App\Models\Structures\Association
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return $model;
    }

    /**
     * Retourne tous les associations avec le minimum d'inforamtion.
     *
     * @return App\Models\Structures\Association $model
     */
    public function minimalAssociation(){
        return $this->model
            ->get(['id','libelle','sigle']);
    }
}
