<?php

namespace App\Services\Params;

use App\Models\Structures\Club;
use App\Repositories\Params\GradePratiquantRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class GradePratiquantService {

    /**
     * @var App\Repositories\Params\GradePratiquantRepository
    */
    protected $dao;

    /**
     * GradePratiquantService constructor
     *
     * @param App\Repositories\Params\GradePratiquantRepository $dao
    */
    public function __construct(GradePratiquantRepository $dao){
        $this->dao = $dao;
    }

    /**
     * Retourne toutes les grades pratiquants des joueurs.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->dao->getAll();
    }

    /**
     * Retourne un grade pratiquant avec toutes les informations.
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
                'age_min' => $item->age_min,
                'age_max' => $item->age_max,
                'active' => $item->active,
                'niveau' => $item->niveau,
            ];
        });
    }

    /**
     * Recupérer un grade pratiquant par son id.
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
                'age_min' => $item->age_min,
                'age_max' => $item->age_max,
                'active' => $item->active,
                'niveau' => $item->niveau,
            ];
        });
    }

    /**
     * Recupérer un grade pratiquant par son id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->dao->getById($id);
    }

    /**
     * Recupérer un grade pratiquant selon l'age.
     *
     * @param $age
     * @return String
     */
    public function getGradeByAge($age)
    {
        return $this->dao->getGradeByAge($age);
    }

    /**
     * Recupérer un grade suivant selon le niveau.
     *
     * @param $niveau
     * @return String
     */
    public function onNext($niveau)
    {
        return $this->dao->onNext($niveau);
    }

    /**
     * Recupérer un grade précédent selon le niveau.
     *
     * @param $niveau
     * @return String
     */
    public function onPrevious($niveau)
    {
        return $this->dao->onPrevious($niveau);
    }

    /**
     * Enregistrer un grade pratiquant
     *
     * @param array $data
     * @param int $federation
     * @return String
     */
    public function add($request)
    {
        $data = $request->only([
            'libelle','sigle','age_min','age_max','active','niveau'
        ]);

        try {
            $result = $this->dao->add($data);
        } catch (Exception $e) {
            throw new InvalidArgumentException('Ajout impossible');
        }

        return $result;
    }

    /**
     * Mettre à jour un grade pratiquant
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
