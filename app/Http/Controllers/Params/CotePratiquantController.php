<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use App\Http\Requests\Params\CotePratiquantRequest;
use App\Models\Params\FonctionPratiquant;
use App\Services\Params\CotePratiquantService;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CotePratiquantController extends Controller
{
    /**
    * @var service
   */
  protected $service;


  /**
   * FederationController Constructor
   *
   * @param App\Services\Params\CotePratiquantService $service
   *
   */
  public function __construct(CotePratiquantService $service)
  {
      $this->service = $service;
  }

   /**
    * Retourne les cotés.
    *
    * @return \Illuminate\Http\Response
   */
   public function index(){
       $cotes = $this->service->allFormatted();

       return Inertia::render('App/Params/Pratiquant/Cote', [
           'cotes' => $cotes,
       ]);
   }

   /**
    * Ajouter un grade.
    *
    * @param  App\Http\Requests\Params\CotePratiquantRequest $request
    * @return \Illuminate\Http\Response
   */
   public function store(CotePratiquantRequest $request)
   {
       try {
           $result['data'] = $this->service->add($request);
       } catch (Exception $e) {
           $result = [
               'status' => 500,
               'error' => $e->getMessage()
           ];
       }

       return Redirect::route('pratiquant.cote.index');
   }

   /**
    * Metre à jour un grade.
    *
    * @param  App\Http\Requests\Params\CotePratiquantRequest  $request
    * @param  int $id
    * @return \Illuminate\Http\Response
   */
   public function update($id, CotePratiquantRequest $request){
       $cote = FonctionPratiquant::findOrFail($id) ;

       $cote->update([
           'libelle' => $request->libelle,
           'sigle' => $request->sigle,
           'active' => $request->active
       ]);

       return Redirect::route('pratiquant.cote.index');
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

       return Redirect::route('pratiquant.cote.index');
   }
}
