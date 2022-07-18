<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use App\Http\Requests\Params\FonctionPratiquantRequest;
use App\Models\Params\FonctionPratiquant;
use App\Services\Params\FonctionPratiquantService;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FonctionPratiquantController extends Controller
{
    /**
    * @var service
   */
  protected $service;


  /**
   * FederationController Constructor
   *
   * @param App\Services\Params\FonctionPratiquantService $service
   *
   */
  public function __construct(FonctionPratiquantService $service)
  {
      $this->service = $service;
  }

   /**
    * Retourne les fontions.
    *
    * @return \Illuminate\Http\Response
   */
   public function index(){
       $fonctions = $this->service->allFormatted();

       return Inertia::render('App/Params/Pratiquant/Fonction', [
           'fonctions' => $fonctions,
       ]);
   }

   /**
    * Ajouter un grade.
    *
    * @param  App\Http\Requests\Params\FonctionPratiquantRequest $request
    * @return \Illuminate\Http\Response
   */
   public function store(FonctionPratiquantRequest $request)
   {
       try {
           $result['data'] = $this->service->add($request);
       } catch (Exception $e) {
           $result = [
               'status' => 500,
               'error' => $e->getMessage()
           ];
       }

       return Redirect::route('pratiquant.fonction.index');
   }

   /**
    * Metre à jour un grade.
    *
    * @param  App\Http\Requests\Params\FonctionPratiquantRequest  $request
    * @param  int $id
    * @return \Illuminate\Http\Response
   */
   public function update($id, FonctionPratiquantRequest $request){
       $fonction = FonctionPratiquant::findOrFail($id) ;

       $fonction->update([
           'libelle' => $request->libelle,
           'sigle' => $request->sigle,
           'active' => $request->active
       ]);

       return Redirect::route('pratiquant.fonction.index');
   }

   /**
    * Supprimer un grade.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
   */
   public function destroy($id){
       $grade = FonctionPratiquant::findOrFail($id);

       //$grade->delete();

       return Redirect::route('pratiquant.fonction.index');
   }
}
