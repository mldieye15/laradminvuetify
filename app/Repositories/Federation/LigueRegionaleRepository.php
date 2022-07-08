<?php

namespace App\Repositories\Federation;
use Illuminate\Support\Facades\DB;
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
     * Recupérer les regions qui n'ont pas de ligue régional
     *
     * @return mixed
     */
    public function regionSansLigRegio()
    {
        $regionSansLigRegio = DB::select("SELECT r.id, r.sigle FROM regions r  left join ligue_regionales l on r.id =l.region_id where l.region_id is null");
        return $regionSansLigRegio;
        /*return $this->model
            ->where('id', $id)
            ->get();*/
    }

    /**
     * Enregistrer un ligue régional
     *
     * @param $data
     * @param $logo
     * @param $region
     * @return LigueRegionale
     */
    public function addLigReg($data, $logo, $region, $federation)
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
        $model->region_id = $region;
        $model->federation_id = $federation;

        $model->save();

        return $model->fresh();
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
    public function maj($data, $ligue, $logo)
    {
        //$model = $this->model->find($ligue);
        $model = $ligue;

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
