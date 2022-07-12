<?php

namespace App\Services\Federation;

use App\Repositories\Federation\LigueRegionaleRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class LigueRegionaleService {

    /**
     * @var LigueRegionaleRepository
    */
    protected $dao;

    /**
     * LigueRegionaleService constructor
     *
     * @param LigueRegionaleRepository $dao
    */
    public function __construct(LigueRegionaleRepository $dao){
        $this->dao = $dao;
    }

    /**
     * Retourne tous les ligues régionales..
     *
     * @return String
     */
    public function getAll()
    {
        return $this->dao->getAll();
    }

    /**
     * Retourne tous les ligues régionales..
     *
     * @return String
     */
    public function minimalLigReg()
    {
        return $this->dao->minimalLigReg();
    }

    /**
     * Retourne la fédération activée dans la base de données.
     *
     * @return String
     */
    public function allFormatted()
    {
        return $this->dao->getAll()->map(function ($item){
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
                'logo' => asset('storage/ligueregional/'.$item->logo),
                'region' => json_encode([
                    'id' => $item->region->id,
                    'libelle' => $item->region->libelle,
                    'sigle' => $item->region->sigle,
                ])
            ];
        });
    }

    /**
     * Recupérer les regions qui n'ont pas de ligue régional.
     *
     * @return String
     */
    public function regionSansLigRegio()
    {
        return $this->dao->regionSansLigRegio();/*->map(function ($item){
            return [
                'id' => $item->id,
                'sigle' => $item->sigle,
            ];
        });*/
    }

    /**
     * Retourne la fédération activée dans la base de données.
     *
     * @return String
     */
    public function simplifiedLigReg()
    {
        return $this->dao->getAll()->map(function ($item){
            return [
                'id' => $item->id,
                'libelle' => $item->libelle,
                'sigle' => $item->sigle,
                'email' => $item->email,
                'adresse' => $item->adresse,
                'telephone' => $item->telephone,
                'logo' => asset('storage/ligueregional/'.$item->logo),
                'region' => json_encode([
                    'id' => $item->region->id,
                    'sigle' => $item->region->sigle,
                ])
            ];
        });
    }

    /**
     * Recupérer un ligue regional par son id.
     *
     * @param $id
     * @return String
     */
    public function getByIdTransformed($id)
    {
        return $this->dao->getById($id)->map(function ($item){
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
                'logo' => asset('storage/ligueregional/'.$item->logo),
                'region' => json_encode([
                    'id' => $item->region->id,
                    'libelle' => $item->region->libelle,
                    'sigle' => $item->region->sigle,
                ])
            ];
        });
    }

    /**
     * Recupérer un ligue regional par son id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->dao->getById($id);
    }

    /**
     * Enregistrer un ligue régional
     *
     * @param array $data
     * @param int $federation
     * @return String
     */
    public function add($request, $federation)
    {
        $map_path = 'map-default.jpg';
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpg,jpeg,png,svg|max:5120', // 5MB
            ]);

            $map_path = $request->file('logo')->store('ligueregional', 'public');
            $map_path = (explode('ligueregional/', $map_path))[1];
        }

        $data = $request->only([
            'libelle','sigle','adresse','telephone','email','date_creation','page_web','instagram','page_web'
        ]);

        try {
            $result = $this->dao->addLigReg($data, $map_path, $request->region['id'], $federation);
        } catch (Exception $e) {
            throw new InvalidArgumentException('Ajout impossible');
        }

        return $result;
    }

    /**
     * Enregistrer un ligue régional
     *
     * @param array $data
     * @param int $federation
     * @return String
     */
    public function maj($request, $id)
    {
        $ligue = $this->dao->getById($id) ;

        $map_path = $ligue->logo;

        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpg,jpeg,png,svg|max:5120',
            ]);

            //  supression du map rataché autre que le map par défaut
            if($ligue->logo != 'map-default.jpg'){
                Storage::delete('public/ligueregional/'.$ligue->logo);
            }

            $map_path = $request->file('logo')->store('ligueregional', 'public');
            $map_path = (explode('ligueregional/', $map_path))[1];
        }

        $data = $request->only([
            'libelle','sigle','adresse','telephone','email','date_creation','page_web','instagram','page_web'
        ]);

        try {
            $result = $this->dao->maj($data, $ligue, $map_path);//($data, $map_path, $request->region['id'], $federation);
        } catch (Exception $e) {
            throw new InvalidArgumentException('Mise à jour impossible');
        }

        return $result;
    }

    /**
     * Metre à jour un ligue régional
     *
     * @param array $data
     * @return String
     */
    public function update($data, $id)
    {
        try {
            $result = null;//$this->dao->update($data, $id);
        } catch (Exception $e) {
            throw new InvalidArgumentException('Mise à jour impossible');
        }

        return $result;

    }


    /**
     * Supprimer un ligue regional par son id.
     *
     * @param $id
     * @return String
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
