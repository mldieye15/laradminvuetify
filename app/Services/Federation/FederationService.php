<?php

namespace App\Services\Federation;

use App\Repositories\Federation\FederationRepository;
use Exception;
use InvalidArgumentException;

class FederationService {

    /**
     * @var FederationRepository
    */
    protected $dao;

    /**
     * LigueRegionaleService constructor
     *
     * @param FederationRepository $dao
    */
    public function __construct(FederationRepository $dao){
        $this->dao = $dao;
    }

    /**
     * Retourne tous les ligues régionales..
     *
     * @return array
     */
    public function getAll()
    {
        return $this->dao->getAll();
    }

    /**
     * Retourne la fédération activée dans la base de données.
     *
     * @return App\Models\Federation\Federation
     */
    public function getFederation()
    {
        return $this->dao->getFederation()->map(function ($item){
            return [
                'id' => $item->id,
                'libelle' => $item->libelle,
                'sigle' => $item->sigle,
                'email' => $item->email,
                'adresse' => $item->adresse,
                'telephone' => $item->telephone,
                'sologan' => $item->sologan,
                'fax' => $item->fax,
                'date_creation' => $item->date_creation,
                'recipisse_numero' => $item->recipisse_numero,
                'recipisse_date' => $item->recipisse_date,
                'recipisse_url' => $item->recipisse_url,
                'reglement_int_url' => $item->reglement_int_url,
                'page_web' => $item->page_web,
                'facebook' => $item->facebook,
                'whatsapp' => $item->whatsapp,
                'telegram' => $item->telegram,
                'instagram' => $item->instagram,
                'tiktok' => $item->tiktok,
                'logo' => asset('storage/federations/'.$item->logo),
                'sport' => json_encode([
                    'id' => $item->sport->id,
                    'libelle' => $item->sport->libelle,
                ])
            ];
        });
    }

    /**
     * Retourne l'id et le libellé de la fédératio uniquement.
     *
     * @return App\Models\Federation\Federation
     */
    public function simplifiedFede()
    {
        return $this->dao->simplifiedFede()->map(function ($item){
            return [
                'id' => $item->id,
                'libelle' => $item->libelle,
            ];
        });
    }

    /**
     * Recupérer un ligue regional par son id.
     *
     * @param $id
     * @return App\Models\Federation\Federation
     */
    public function getById($id)
    {
        return $this->dao->getById($id);
    }

    /**
     * Enregistrer un ligue régional
     *
     * @param array $data
     * @return App\Models\Federation\Federation
     */
    public function add($data)
    {
        /*$validator = Validator::make($data, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }*/

        try {
            $result = $this->dao->save($data);
        } catch (Exception $e) {
            throw new InvalidArgumentException('Mise à jour impossible');
        }
        //$result = $this->dao->save($data);

        return $result;
    }

    /**
     * Metre à jour un ligue régional
     *
     * @param array $data
     * @return App\Models\Federation\Federation
     */
    public function maj($data, $id)
    {
        try {
            $result = $this->dao->update($data, $id);
        } catch (Exception $e) {
            throw new InvalidArgumentException('Mise à jour impossible');
        }

        return $result;

    }


    /**
     * Supprimer un ligue regional par son id.
     *
     * @param $id
     * @return mixed
     */
    public function delById($id)
    {
        //DB::beginTransaction();

        try {
            $result = $this->dao->delete($id);
        } catch (Exception $e) {
            throw new InvalidArgumentException('Suppression impossible');
        }
        //DB::commit();

        return $result;

    }
}
