<?php

namespace App\Services\Params;

use App\Models\Structures\Club;
use App\Repositories\Params\FonctionPratiquantRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class FonctionPratiquantService {

    /**
     * @var App\Repositories\Params\FonctionPratiquantRepository
    */
    protected $dao;

    /**
     * FonctionPratiquantService constructor
     *
     * @param App\Repositories\Params\FonctionPratiquantRepository $dao
    */
    public function __construct(FonctionPratiquantRepository $dao){
        $this->dao = $dao;
    }

    /**
     * Retourne toutes les fonstions des joueurs.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->dao->getAll();
    }

    /**
     * Retourne un coté pratiquant avec toutes les informations.
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
                'active' => $item->active,
            ];
        });
    }

    /**
     * Recupérer un coté pratiquant par son id.
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
                'active' => $item->active,
            ];
        });
    }

    /**
     * Recupérer un coté pratiquant par son id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->dao->getById($id);
    }

    /**
     * Enregistrer un côté pratiquant
     *
     * @param array $data
     * @param int $federation
     * @return String
     */
    public function add($request)
    {
        $data = $request->only([
            'libelle','sigle','active',
        ]);

        try {
            $result = $this->dao->add($data);
        } catch (Exception $e) {
            throw new InvalidArgumentException('Ajout impossible');
        }

        return $result;
    }

    /**
     * Mettre à jour un côté pratiquant
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
                Storage::delete('public/associations/'.$club->logo);
            }

            $map_path = $request->file('logo')->store('clubs', 'public');
            $map_path = (explode('associations/', $map_path))[1];
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
}
