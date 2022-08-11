<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\PersonneRequest;
use App\Models\User\Personne;
use App\Services\Localisation\PaysService;
use App\Services\Params\CotePratiquantService;
use App\Services\Params\FonctionPratiquantService;
use App\Services\User\PratiquantService;
use App\Services\Structures\TypeStructureService;
use App\Services\User\DemandeService;
use App\Services\User\PersonneService;
use App\Services\User\TypeDemandeService;
use App\Traits\RefGenerator;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PersonneController extends Controller
{
    use RefGenerator;
/**
    * @var service
*/
  protected $service;

/**
   * @var paysService
*/
 protected $paysService;

/**
   * @var cotePratiqService
*/
 protected $cotePratiqService;

/**
   * @var fonctPratiqService
*/
protected $fonctPratiqService;

/**
   * @var fonctPratiqService
*/
protected $typeStructService;


/**
   * @var pratiqService
*/
//protected $pratiqService;

/**
   * @var typeDemandeService
*/
protected $typeDemandeService;

/**
   * @var demandeService
*/
protected $demandeService;

  /**
   * PersonneController Constructor
   *
   * @param App\Services\User\PersonneService $service
   * @param App\Services\Params\FonctionPratiquantService $fonctPratiqService
   * @param App\Services\Localisation\PaysService $paysService
   * @param App\Services\Params\CotePratiquantService $cotePratiqService
   * @param App\Services\Structures\TypeStructureService $typeStructService
   * @param App\Services\Params\PratiquantService $pratiqService
   * @param App\Services\User\DemandeService $demandeService
   *
   */
  public function __construct(PersonneService $service,
                              PaysService $paysService,
                              CotePratiquantService $cotePratiqService,
                              FonctionPratiquantService $fonctPratiqService,
                              TypeStructureService $typeStructService,
                              //PratiquantService $pratiqService,
                              TypeDemandeService $typeDemandeService,
                              DemandeService $demandeService
                             )
  {
      $this->service = $service;
      $this->paysService = $paysService;
      $this->cotePratiqService = $cotePratiqService;
      $this->fonctPratiqService = $fonctPratiqService;
      $this->typeStructService = $typeStructService;
      //$this->pratiqService = $pratiqService;
      $this->typeDemandeService = $typeDemandeService;
      $this->demandeService = $demandeService;
  }

   /**
    * Retourne toutes les personnes.
    *
    * @return \Illuminate\Http\Response
   */
   public function index(){
       $personnes = $this->service->allFormatted();

       return Inertia::render('App/User/Personne/Index', [
           'personnes' => $personnes,
       ]);
   }

   /**
    * Retourne la page de création d'une personne.
    *  @return \Illuminate\Http\Response
   */
   public function create(){
       $pays = $this->paysService->minimalPays();
       $currentPays = $this->paysService->getCurrentPays();
       $cotePratiquants = $this->cotePratiqService->getAll() ;
       $fonctionPratiquants = $this->fonctPratiqService->getAll() ;
       $typeStructureListe = $this->typeStructService->getAll() ;
       $typeDemandeListe = $this->typeDemandeService->getAll();

       return Inertia::render('App/User/Personne/New', [
           'pays' => $pays,
           'currentPays' => $currentPays,
           'cotePratiquants' => $cotePratiquants,
           'fonctionPratiquants' => $fonctionPratiquants,
           'typeStructureListe' => $typeStructureListe,
           'typeDemandeListe' => $typeDemandeListe
       ]);
   }

   /**
    * Retourne la page de modification d'une personne.
    *  @return \Illuminate\Http\Response
   */
   public function edit(Request $request){
       $personne = $this->service->getByIdTransformed($request->personne);
       $pays = $this->paysService->minimalPays();

       return Inertia::render('App/User/Personne/Edit', [
           'personne' => $personne,
           'pays' => $pays
       ]);
   }

   /**
    * Retourne une personne.
    *
    *  @param $id
    *  @return \Illuminate\Http\Response
   */
   public function show($id){
       $personne = $this->service->getByIdTransformed($id);

       return Inertia::render('App/User/Personne/Details', [
           'personne' => $personne,
       ]);
   }

   /**
    * Ajouter une personne.
    *
    * @param  App\Http\Requests\User\PersonneRequest $request
    * @return \Illuminate\Http\Response
   */
   public function store(PersonneRequest $request)
   {
       try {
           $result = $this->service->add($request);

           $demandeData = [
            'personne' => $result['id'],
            'typedemande' => $request->typedemande['id'],
            'fonction' => $request->fonction_pratiq['id'],
            'cote' => $request->cote_pratiq['id'],
            'typestructure' => $request->type_struct['id'],
            'structure' => $request->structure['id'],
            //'ins' => $this->getNatioSportifId(),
           ];
           //$demande =
           $this->demandeService->add($demandeData);
       } catch (Exception $e) {
           $result = [
               'status' => 500,
               'error' => $e->getMessage()
           ];
       }

       return Redirect::route('personne.index');
   }

   /**
    * Metre à jour une personne.
    *
    * @param  App\Http\Requests\User\PersonneRequest  $request
    * @param  int $id
    * @return \Illuminate\Http\Response
   */
   public function update($id, PersonneRequest $request){
       $personne = Personne::findOrFail($id) ;

       $map_path = $personne->photo;
       if ($request->hasFile('photo')) {
           $request->validate([
               'logo' => 'image|mimes:jpg,jpeg,png,svg|max:5120',
           ]);

           //  supression du map rataché autre que le map par défaut
           if($personne->photo != 'default-pers.jpg'){
               Storage::delete('public/personnes/'.$personne->photo);
           }

           $map_path = $request->file('photo')->store('personnes', 'public');
           $map_path = (explode('personnes/', $map_path))[1];
       }

       $personne->update([
            'prenoms' => $request->prenoms,
            'nom' => $request->nom,
            'sexe' => $request->sexe,
            'surnom' => $request->surnom,
            'taille' => $request->taille,
            'poids' => $request->poids,
            'fonction' => $request->fonction,
            'ne_vers' => $request->ne_vers,
            'date_naiss' => $request->date_naiss,
            'lieu_naiss' => $request->lieu_naiss,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'civilite' => $request->civilite,
            'email' => $request->email,
            'type_piece_ident' => $request->type_piece_ident,
            'piece_ident' => $request->piece_ident,
            'annee_naiss' => $request->annee_naiss,
            'ne_vers_naiss' => $request->ne_vers_naiss,
            'cin' => $request->cin,
            'passport' => $request->passport,
            'page_web' => $request->page_web,
            'facebook' => $request->facebook,
            'whatsapp' => $request->whatsapp,
            'telegram' => $request->telegram,
            'instagram' => $request->instagram,
            'tiktok' => $request->tiktok,
            'active' => $request->active,
            'photo' => $map_path,
            'pays_naiss' => $request->pays['id'],
            'pays_natio' => $request->nationalite['id']
       ]);

       return Redirect::route('personne.index');
   }

   /**
    * Supprimer une personne.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
   */
   public function destroy($id){
       $personne = Personne::findOrFail($id);

       if($personne->photo != 'default-pers.jpg'){
           Storage::delete('public/personnes/'.$personne->photo);
       }

       $personne->delete();

       return Redirect::route('personne.index');
   }

   /**
    * Retourne la page de création d'une personne.
    *  @return \Illuminate\Http\Response
   */
   public function getStructByTypeStruct(Request $request){
        $typeStruct = $request->typeStruct;
        switch ($typeStruct) {
            case 'CLUB':   //  Club
                # code...
                break;
            case 'CENTRE':   //  Centre
                # code...
                break;
            case 'ASC':   //  Association
                # code...
                break;
            default:    //  Equipe nationale
                # code...
                break;
        }
   }
}
