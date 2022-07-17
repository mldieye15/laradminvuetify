<?php

namespace App\Repositories\User;

use App\Models\User\Personne;

class PersonneRepository {

    /**
     * @var App\Models\User\Personne
    */
    protected $model;

    /**
     * PersonneRepository constructor
     *
     * @param App\Models\User\Personne $model
    */
    public function __construct(Personne $model){
        $this->model = $model;
    }

    /**
     * Retourne toutes les personnes.
     *
     * @return App\Models\User\Personne $model
     */
    public function getAll()
    {
        return $this->model
            ->get();
    }

    /**
     * Retourne toutes les personnes active.
     *
     * @return App\Models\User\Personne $model
     */
    public function getAllByActive($active = true)
    {
        return $this->model
            ->where('active', $active)
            ->get();
    }

    /**
     * Recupérer une personne par son id
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
     * Recupérer une personne par son id
     *
     * @param $id
     * @return mixed
     */
    public function getPersByIdActive($id, $active = true)
    {
        return $this->model
            ->where(['id', $id], ['active', $active])
            ->get();
    }

    /**
     * Recupérer une personne par son email
     *
     * @param $email
     * @return mixed
     */
    public function getPersByEmailActive($email, $active = true)
    {
        return $this->model
            ->where(['email', $email], ['active', $active])
            ->get();
    }

    /**
     * Recupérer une personne par son email
     *
     * @param $email
     * @return mixed
     */
    public function getPersByEmail($email)
    {
        return $this->model
            ->where('email', $email)
            ->get();
    }

    /**
     * Recupérer une personne par son piece_ident
     *
     * @param $pieceIdent
     * @return mixed
     */
    public function getPersByPieceIdent($pieceIdent)
    {
        return $this->model
            ->where('piece_ident', $pieceIdent)
            ->get();
    }

    /**
     * Enregistrer une personne
     *
     * @param $data
     * @param $photo
     * @param $ligue
     * @return App\Models\User\Personne
     */
    public function add($data, $photo, $pays_naiss, $pays_natio)
    {
        $model = new $this->model;
        
        $model->prenoms = $data['prenoms'];
        $model->nom = $data['nom'];
        $model->sexe = $data['sexe'];
        $model->surnom = $data['surnom'];
        $model->taille = $data['taille'];
        $model->poids = $data['poids'];
        $model->fonction = $data['fonction'];
        $model->ne_vers = $data['ne_vers'];
        $model->date_naiss = $data['date_naiss'];
        $model->lieu_naiss = $data['lieu_naiss'];
        $model->adresse = $data['adresse'];
        $model->telephone = $data['telephone'];
        $model->civilite = $data['civilite'];
        $model->email = $data['email'];
        $model->type_piece_ident = $data['type_piece_ident'];
        $model->piece_ident = $data['piece_ident'];
        $model->annee_naiss = $data['annee_naiss'];
        $model->ne_vers_naiss = $data['ne_vers_naiss'];
        $model->cin = $data['cin'];
        $model->passport = $data['passport'];
        $model->page_web = $data['page_web'];
        $model->facebook = $data['facebook'];
        $model->whatsapp = $data['whatsapp'];
        $model->telegram = $data['telegram'];
        $model->instagram = $data['instagram'];
        $model->tiktok = $data['tiktok'];
        $model->active = $data['active'];
        $model->photo = $photo;
        $model->pays_naiss = $pays_naiss;
        $model->pays_natio = $pays_natio;
        //dd($model);
        $model->save();

        return $model->fresh();
    }

    /**
     * Metre à jour une personne
     *
     * @param $data
     * @param App\Models\User\Personne $club
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
     * Supprimer une personne
     *
     * @param $id
     * @return App\Models\User\Personne
     */
    public function delete($id)
    {
        $model = $this->model->find($id);
        $model->delete();

        return $model;
    }

}
