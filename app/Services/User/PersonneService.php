<?php

namespace App\Services\User;

use App\Models\Structures\Club;
use App\Repositories\User\PersonneRepository;
use Exception;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;

class PersonneService {

    /**
     * @var App\Repositories\User\PersonneRepository
    */
    protected $dao;

    /**
     * PersonneService constructor
     *
     * @param App\Repositories\User\PersonneRepository $dao
    */
    public function __construct(PersonneRepository $dao){
        $this->dao = $dao;
    }

    /**
     * Retourne toutes les personnes.
     *
     * @return String
     */
    public function getAll()
    {
        return $this->dao->getAll();
    }

    /**
     * Retourne une personne avec toutes les informations.
     *
     * @return String
     */
    public function allFormatted()
    {
        return $this->dao->getAllByActive()->map(function ($item){
            return [
                'id' => $item->id,
                'prenoms' => $item->prenoms,
                'nom' => $item->nom,
                'sexe' => $item->sexe,
                'surnom' => $item->surnom,
                'taille' => $item->taille,
                'poids' => $item->poids,
                'fonction' => $item->fonction,
                'ne_vers' => $item->ne_vers,
                'date_naiss' => $item->date_naiss,
                'lieu_naiss' => $item->lieu_naiss,
                'adresse' => $item->adresse,
                'telephone' => $item->telephone,
                'civilite' => $item->civilite,
                'email' => $item->email,
                'type_piece_ident' => $item->type_piece_ident,
                'piece_ident' => $item->piece_ident,
                'annee_naiss' => $item->annee_naiss,
                'ne_vers_naiss' => $item->ne_vers_naiss,
                'cin' => $item->cin,
                'passport' => $item->passport,
                'page_web' => $item->page_web,
                'facebook' => $item->facebook,
                'whatsapp' => $item->whatsapp,
                'telegram' => $item->telegram,
                'instagram' => $item->instagram,
                'tiktok' => $item->tiktok,
                'active' => $item->active,
                'photo' => asset('storage/personnes/'.$item->photo),
                'pays_naiss' => json_encode([
                    'id' => $item->pays->id,
                    'libelle' => $item->pays->libelle,
                    'sigle' => $item->pays->sigle,
                ]),
                'pays_natio' => json_encode([
                    'id' => $item->nationalite->id,
                    'libelle' => $item->nationalite->libelle,
                    'sigle' => $item->nationalite->sigle,
                ]),
            ];
        });
    }

    /**
     * Retourne une personne.
     *
     * @return String
     */
    public function simplifiedPersonne()
    {
        return $this->dao->getAllByActive()->map(function ($item){
            return [
                'id' => $item->id,
                'prenoms' => $item->prenoms,
                'nom' => $item->nom,
                'sexe' => $item->sexe,
                'surnom' => $item->surnom,
                'taille' => $item->taille,
                'poids' => $item->poids,
                'fonction' => $item->fonction,
                'ne_vers' => $item->ne_vers,
                'date_naiss' => $item->date_naiss,
                'lieu_naiss' => $item->lieu_naiss,
                'adresse' => $item->adresse,
                'telephone' => $item->telephone,
                'civilite' => $item->civilite,
                'email' => $item->email,
                'type_piece_ident' => $item->type_piece_ident,
                'piece_ident' => $item->piece_ident,
                'annee_naiss' => $item->annee_naiss,
                'ne_vers_naiss' => $item->ne_vers_naiss,
                'cin' => $item->cin,
                'passport' => $item->passport,
                'page_web' => $item->page_web,
                'facebook' => $item->facebook,
                'whatsapp' => $item->whatsapp,
                'telegram' => $item->telegram,
                'instagram' => $item->instagram,
                'tiktok' => $item->tiktok,
                'active' => $item->active,
                'photo' => asset('storage/personnes/'.$item->photo),
                'pays_naiss' => json_encode([
                    'id' => $item->pays->id,
                    'libelle' => $item->pays->libelle,
                    'sigle' => $item->pays->sigle,
                ]),
                'pays_natio' => json_encode([
                    'id' => $item->nationalite->id,
                    'libelle' => $item->nationalite->libelle,
                    'sigle' => $item->nationalite->sigle,
                ]),
            ];
        });
    }

    /**
     * Recupérer une personne par son id.
     *
     * @param $id
     * @return String
     */
    public function getByIdTransformed($id)
    {
        return $this->dao->getById($id)->map(function ($item){
            return [
                'id' => $item->id,
                'prenoms' => $item->prenoms,
                'nom' => $item->nom,
                'sexe' => $item->sexe,
                'surnom' => $item->surnom,
                'taille' => $item->taille,
                'poids' => $item->poids,
                'fonction' => $item->fonction,
                'ne_vers' => $item->ne_vers,
                'date_naiss' => $item->date_naiss,
                'lieu_naiss' => $item->lieu_naiss,
                'adresse' => $item->adresse,
                'telephone' => $item->telephone,
                'civilite' => $item->civilite,
                'email' => $item->email,
                'type_piece_ident' => $item->type_piece_ident,
                'piece_ident' => $item->piece_ident,
                'annee_naiss' => $item->annee_naiss,
                'ne_vers_naiss' => $item->ne_vers_naiss,
                'cin' => $item->cin,
                'passport' => $item->passport,
                'page_web' => $item->page_web,
                'facebook' => $item->facebook,
                'whatsapp' => $item->whatsapp,
                'telegram' => $item->telegram,
                'instagram' => $item->instagram,
                'tiktok' => $item->tiktok,
                'active' => $item->active,
                'photo' => asset('storage/personnes/'.$item->photo),
                'pays_naiss' => json_encode([
                    'id' => $item->pays->id,
                    'libelle' => $item->pays->libelle,
                    'sigle' => $item->pays->sigle,
                ]),
                'pays_natio' => json_encode([
                    'id' => $item->nationalite->id,
                    'libelle' => $item->nationalite->libelle,
                    'sigle' => $item->nationalite->sigle,
                ]),
            ];
        });
    }

    /**
     * Recupérer une personne par son id.
     *
     * @param $id
     * @return String
     */
    public function getById($id)
    {
        return $this->dao->getById($id);
    }
    

    /**
     * Enregistrer une personne
     *
     * @param array $data
     * @return String
     */
    public function add($request)
    {
        $map_path = 'default-pers.jpg';
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,svg|max:5120', // 5MB
            ]);

            $map_path = $request->file('photo')->store('personnes', 'public');
            $map_path = (explode('personnes/', $map_path))[1];
        }

        $data = $request->only([
            'prenoms','nom','sexe','surnom','taille','poids','fonction','ne_vers','date_naiss','lieu_naiss','adresse','telephone','civilite','email','type_piece_ident','piece_ident','annee_naiss','ne_vers_naiss','cin','passport',
            'page_web','facebook','whatsapp','telegram','instagram','tiktok','active'
        ]);
        
        try {
            $result = $this->dao->add($data, $map_path, $request->pays['id'], $request->nationalite['id']);
        } catch (Exception $e) {
            throw new InvalidArgumentException('Ajout impossible');
        }

        return $result;
    }

    /**
     * Mettre à jour un ligue régional
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
