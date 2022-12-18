<?php

namespace App\Http\Controllers\Structures;

use App\Http\Controllers\Controller;
use App\Http\Requests\Structures\StructureRequest;
use App\Models\Federation\LigueRegionale;
use App\Models\Structures\Association;
use App\Services\Federation\LigueRegionaleService;
use App\Services\Structures\AssociationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AssociationController extends Controller
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
   * FederationController Constructor
   *
   * @param App\Services\Federation\LigueRegionaleService $ligueService
   * @param App\Services\Federation\AssociationService $service
   *
   */
  public function __construct(AssociationService $service, LigueRegionaleService $ligueService)
  {
      $this->service = $service;
      $this->ligueService = $ligueService;
  }

   /**
    * Retourne les associations.
    *
    * @return \Illuminate\Http\Response
   */
   public function index(){
       $associations = $this->service->allFormatted();

       return Inertia::render('App/Structures/Association/Index', [
           'associations' => $associations,
       ]);
   }

   /**
    * Retourne la page de création d'un club.
    *  @return \Illuminate\Http\Response
   */
   public function create(){
       $ligueRegionales = $this->ligueService->minimalLigReg();

       return Inertia::render('App/Structures/Association/New', [
           'ligueRegionales' => $ligueRegionales
       ]);
   }

   /**
    * Retourne la page de création d'une assocaition.
    *  @return \Illuminate\Http\Response
   */
   public function edit(Request $request){
       $association = $this->service->getByIdTransformed($request->club);
       $ligueRegionales = $this->ligueService->minimalLigReg();

       return Inertia::render('App/Structures/Association/Edit', [
           'association' => $association,
           'ligueRegionales' => $ligueRegionales
       ]);
   }

   /**
    * Retourne une assocaition.
    *
    *  @param $id
    *  @return \Illuminate\Http\Response
   */
   public function show($id){
       $association = $this->service->getById($id);

       return Inertia::render('App/Structures/Association/Details', [
           'association' => $association,
       ]);
   }

   /**
    * Ajouter un ligue régional.
    *
    * @param  App\Http\Requests\Structures\StructureRequest $request
    * @return \Illuminate\Http\Response
   */
   public function store(StructureRequest $request)
   {
       try {
           $result['data'] = $this->service->add($request);
       } catch (Exception $e) {
           $result = [
               'status' => 500,
               'error' => $e->getMessage()
           ];
       }

       return Redirect::route('association.index');
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

       return Redirect::route('association.index');
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

       return Redirect::route('association.index');
   }

   /**
     * Retourne le minuimum d'une association: id, libelle, sigle
     *
     */
    public function ajaxListeAssociation()
    {
        $centreForms = $this->service->minimalAssociation();;
        return response()->json($centreForms);
    }

    /**
     * Retourne le minuimum d'un centre de formation: id, libelle, sigle
     *
     */
    public function ajaxListeAssociationByLigue($ligue)
    {
        $associations = $this->service->minimalAssociationByLigue($ligue);
        return response()->json($associations);
    }
}
