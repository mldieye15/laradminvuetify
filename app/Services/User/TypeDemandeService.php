<?php

namespace App\Services\User;

use App\Repositories\User\TypeDemandeRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class TypeDemandeService {

    /**
     * @var App\Repositories\User\TypeDemandeRepository
    */
    protected $dao;

    /**
     * ClubService constructor
     *
     * @param App\Repositories\User\TypeDemandeRepository $dao
    */
    public function __construct(TypeDemandeRepository $dao){
        $this->dao = $dao;
    }

    /**
     * Retourne toutes les demandes.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->dao->getAll();
    }

    /**
     * Retourne une demande.
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
                'visible' => $item->visible
            ];
        });
    }

    /**
     * Recupérer une demande par son id.
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
                'visible' => $item->visible
            ];
        });
    }

    /**
     * Recupérer une demande par son id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->dao->getById($id);
    }

    /**
     * Enregistrer une demande
     *
     * @param array $data
     * @return String
     */
    public function add($data)
    {
        //dd($data);
        try {
            $result = $this->dao->add($data);
        } catch (Exception $e) {
            throw new InvalidArgumentException('Ajout impossible');
        }

        return $result;
    }

    /**
     * Mettre à jour une demande
     *
     * @param array $data
     * @param int $federation
     * @return String
     */
    public function maj($request, $id)
    {
        $club = $this->dao->getById($id) ;
        //$club = Club::findOrFail($id) ;
        //dd($club->logo);
        $map_path = $club[0]->logo;

        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpg,jpeg,png,svg|max:5120',
            ]);

            //  supression du map rataché autre que le map par défaut
            if($map_path != 'map-default.png'){
                Storage::delete('public/clubs/'.$club->logo);
            }

            $map_path = $request->file('logo')->store('clubs', 'public');
            $map_path = (explode('clubs/', $map_path))[1];
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

    /**
     * Supprimer un club par son id.
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
     * Retourne tous les clubs avec le minimum d'infomation.
     *
     * @return String
     */
    public function minimalClub()
    {
        return $this->dao->minimalClub();
    }
}
