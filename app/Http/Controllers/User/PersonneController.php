<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Structures\StructureRequest;
use App\Http\Requests\User\PersonneRequest;
use App\Models\Federation\LigueRegionale;
use App\Models\Structures\Association;
use App\Services\Localisation\PaysService;
use App\Services\User\PersonneService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PersonneController extends Controller
{
    /**
    * @var service
   */
  protected $service;

  /**
   * @var ligueService
  */
 protected $ligueService;

  /**
   * PersonneController Constructor
   *
   * @param App\Services\Localisation\PaysService $paysService
   * @param App\Services\User\PersonneService $service
   *
   */
  public function __construct(PersonneService $service, PaysService $paysService)
  {
      $this->service = $service;
      $this->paysService = $paysService;
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
    * Retourne la page de création d'un club.
    *  @return \Illuminate\Http\Response
   */
   public function create(){
       $pays = $this->paysService->minimalPays();
       $currentPays = $this->paysService->getCurrentPays();

       return Inertia::render('App/User/Personne/New', [
           'pays' => $pays,
           'currentPays' => $currentPays,
       ]);
   }

   /**
    * Retourne la page de modification d'une personne.
    *  @return \Illuminate\Http\Response
   */
   public function edit(Request $request){
       $association = $this->service->getByIdTransformed($request->club);
       $pays = $this->paysService->minimalPays();

       return Inertia::render('App/User/Personne/Edit', [
           'association' => $association,
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
       $personne = $this->service->getById($id);

       return Inertia::render('App/User/Personne/Details', [
           'personne' => $personne,
       ]);
   }

   /**
    * Ajouter un ligue régional.
    *
    * @param  use App\Http\Requests\User\PersonneRequest; $request
    * @return \Illuminate\Http\Response
   */
   public function store(PersonneRequest $request)
   {
       try {
           $result = $this->service->add($request);
       } catch (Exception $e) {
           $result = [
               'status' => 500,
               'error' => $e->getMessage()
           ];
       }

       return Redirect::route('personne.index');
   }

   /**
    * Metre à jour un ligue régional.
    *
    * @param  App\Http\Requests\Structures\ClubRequest  $request
    * @param  int $id
    * @return \Illuminate\Http\Response
   */
   public function update($id, StructureRequest $request){
       $club = Association::findOrFail($id) ;

       $map_path = $club->logo;
       if ($request->hasFile('logo')) {
           $request->validate([
               'logo' => 'image|mimes:jpg,jpeg,png,svg|max:5120',
           ]);

           //  supression du map rataché autre que le map par défaut
           if($club->logo != 'map-default.png'){
               Storage::delete('public/associations/'.$club->logo);
           }

           $map_path = $request->file('logo')->store('associations', 'public');
           $map_path = (explode('associations/', $map_path))[1];
       }

       $club->update([
           'libelle' => $request->libelle,
           'sigle' => $request->sigle,
           'adresse' => $request->adresse,
           'telephone' => $request->telephone,
           'email' => $request->email,
           'date_creation' => $request->date_creation,
           'page_web' => $request->page_web,
           'instagram' => $request->instagram,
           'logo' => $map_path,
           'ligue_regionale_id' => $request->ligue['id']
       ]);

       return Redirect::route('personne.index');
   }

   /**
    * Supprimer un quartier.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
   */
   public function destroy($id){
       $ligue = LigueRegionale::findOrFail($id);

       if($ligue->map != 'map-default.png'){
           Storage::delete('public/associations/'.$ligue->logo);
       }

       $ligue->delete();

       return Redirect::route('personne.index');
   }
}
