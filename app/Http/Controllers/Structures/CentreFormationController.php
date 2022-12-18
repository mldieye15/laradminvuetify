<?php

namespace App\Http\Controllers\Structures;

use App\Http\Controllers\Controller;
use App\Http\Requests\Structures\StructureRequest;
use App\Models\Federation\LigueRegionale;
use App\Models\Structures\CentreFormation;
use App\Services\Federation\LigueRegionaleService;
use App\Services\Structures\CentreFormationService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CentreFormationController extends Controller
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
   * @param App\Services\Federation\CentreFormationService $service
   *
   */
  public function __construct(CentreFormationService $service, LigueRegionaleService $ligueService)
  {
      $this->service = $service;
      $this->ligueService = $ligueService;
  }

   /**
    * Retourne les clubs.
    *
    * @return \Illuminate\Http\Response
   */
   public function index(){
       $centres = $this->service->allFormatted();

       return Inertia::render('App/Structures/CentreFormation/Index', [
           'centres' => $centres,
       ]);
   }

   /**
    * Retourne la page de création d'un centre de formaton.
    *  @return \Illuminate\Http\Response
   */
   public function create(){
       $ligueRegionales = $this->ligueService->minimalLigReg();

       return Inertia::render('App/Structures/CentreFormation/New', [
           'ligueRegionales' => $ligueRegionales
       ]);
   }

   /**
    * Retourne la page de création d'un centre de formation.
    *  @return \Illuminate\Http\Response
   */
   public function edit(Request $request){
       $centre = $this->service->getByIdTransformed($request->club);
       $ligueRegionales = $this->ligueService->minimalLigReg();

       return Inertia::render('App/Structures/CentreFormation/Edit', [
           'centre' => $centre,
           'ligueRegionales' => $ligueRegionales
       ]);
   }

   /**
    * Retourne les centres de formation.
    *
    *  @param $id
    *  @return \Illuminate\Http\Response
   */
   public function show($id){
       $centre = $this->service->getById($id);

       return Inertia::render('App/Structures/CentreFormation/Details', [
           'centre' => $centre,
       ]);
   }

   /**
    * Ajouter un centre de formation.
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

       return Redirect::route('centreform.index');
   }

   /**
    * Metre à jour un centre de formation.
    *
    * @param  App\Http\Requests\Structures\StructureRequest  $request
    * @param  int $id
    * @return \Illuminate\Http\Response
   */
   public function update($id, StructureRequest $request){
       $club = CentreFormation::findOrFail($id) ;

       $map_path = $club->logo;
       if ($request->hasFile('logo')) {
           $request->validate([
               'logo' => 'image|mimes:jpg,jpeg,png,svg|max:5120',
           ]);

           //  supression du map rataché autre que le map par défaut
           if($club->logo != 'map-default.png'){
               Storage::delete('public/centres/'.$club->logo);
           }

           $map_path = $request->file('logo')->store('centres', 'public');
           $map_path = (explode('centres/', $map_path))[1];
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

       return Redirect::route('centreform.index');
   }

   /**
    * Supprimer un centre de formation.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
   */
   public function destroy($id){
       $ligue = LigueRegionale::findOrFail($id);

       if($ligue->map != 'map-default.png'){
           Storage::delete('public/centres/'.$ligue->logo);
       }

       $ligue->delete();

       return Redirect::route('centreform.index');
   }

   /**
     * Retourne le minuimum d'un centre de formation: id, libelle, sigle
     *
     */
    public function ajaxListeCentreForm()
    {
        $centreForms = $this->service->minimalCentreForm();;
        return response()->json($centreForms);
    }

    /**
     * Retourne le minuimum d'un centre de formation: id, libelle, sigle
     *
     */
    public function ajaxListeCentreFormByLigue($ligue)
    {
        $centres = $this->service->minimalCentreFormByLigue($ligue);
        return response()->json($centres);
    }
}
