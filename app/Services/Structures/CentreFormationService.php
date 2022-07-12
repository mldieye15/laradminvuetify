<?php

namespace App\Services\Structures;

use App\Models\Structures\Club;
use App\Repositories\Structures\CentreFormationRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class CentreFormationService {

    /**
     * @var App\Repositories\Structures\CentreFormationRepository
    */
    protected $dao;

    /**
     * CentreFormationService constructor
     *
     * @param App\Repositories\Structures\CentreFormationRepository $dao
    */
    public function __construct(CentreFormationRepository $dao){
        $this->dao = $dao;
    }

    /**
     * Retourne tous les centres de foamtion.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->dao->getAll();
    }

    /**
     * Retourne un centre de formation avec toutes les informations.
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
                'logo' => asset('storage/centres/'.$item->logo),
                'ligue_regionale' => json_encode([
                    'id' => $item->ligue_regionale->id,
                    'libelle' => $item->ligue_regionale->libelle,
                    'sigle' => $item->ligue_regionale->sigle,
                ])
            ];
        });
    }

    /**
     * Retourne un centre de formation avec moins d'éléments.
     *
     * @return String
     */
    public function simplifiedClub()
    {
        return $this->dao->getAll()->map(function ($item){
            return [
                'id' => $item->id,
                'libelle' => $item->libelle,
                'sigle' => $item->sigle,
                'email' => $item->email,
                'adresse' => $item->adresse,
                'telephone' => $item->telephone,
                'logo' => asset('storage/centres/'.$item->logo),
                'ligue_regionale' => json_encode([
                    'id' => $item->ligue_regionale->id,
                    'sigle' => $item->ligue_regionale->sigle,
                ])
            ];
        });
    }

    /**
     * Recupérer un centre de formation par son id.
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
                'logo' => asset('storage/centres/'.$item->logo),
                'ligue_regionale' => json_encode([
                    'id' => $item->ligue_regionale->id,
                    'libelle' => $item->ligue_regionale->libelle,
                    'sigle' => $item->ligue_regionale->sigle,
                ])
            ];
        });
    }

    /**
     * Recupérer un centre de formation par son id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->dao->getById($id);
    }

    /**
     * Enregistrer un centre de formation
     *
     * @param array $data
     * @param int $federation
     * @return String
     */
    public function add($request)
    {
        $map_path = 'map-default.png';
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpg,jpeg,png,svg|max:5120', // 5MB
            ]);

            $map_path = $request->file('logo')->store('centres', 'public');
            $map_path = (explode('centres/', $map_path))[1];
        }

        $data = $request->only([
            'libelle','sigle','adresse','telephone','email','date_creation','page_web','instagram','page_web'
        ]);

        try {
            $result = $this->dao->add($data, $map_path, $request->ligue['id']);//addLigReg($data, $map_path, $request->region['id'], $federation);
        } catch (Exception $e) {
            throw new InvalidArgumentException('Ajout impossible');
        }

        return $result;
    }

    /**
     * Supprimer un centre de formation par son id.
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

    /**
     * Mettre à jour un centre de formation
     *
     * @param array $data
     * @param int $federation
     * @return String
     */
    public function maj($request, $id)
    {
        $club = $this->dao->getById($id) ;
        $club = Club::findOrFail($id) ;
        //dd($club->logo);
        $map_path = $club[0]->logo;

        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpg,jpeg,png,svg|max:5120',
            ]);

            //  supression du map rataché autre que le map par défaut
            if($map_path != 'map-default.png'){
                Storage::delete('public/centres/'.$club->logo);
            }

            $map_path = $request->file('logo')->store('centres', 'public');
            $map_path = (explode('centres/', $map_path))[1];
        }

        $data = $request->only([
            'libelle','sigle','adresse','telephone','email','date_creation','page_web','instagram','page_web'
        ]);

        try {
            $result = $this->dao->maj($data, $club[0], $map_path, $request->ligue['id']);
        } catch (Exception $e) {
            throw new InvalidArgumentException('Mise à jour impossible');
        }

        return $result;
    }


}
