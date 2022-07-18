<?php

namespace App\Http\Controllers\Params;

use App\Http\Controllers\Controller;
use App\Http\Requests\Params\GradePratiquantRequest;
use App\Models\Params\GradePratiquant;
use App\Services\Params\GradePratiquantService;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class GradePratiquantController extends Controller
{
    /**
    * @var service
   */
  protected $service;


  /**
   * FederationController Constructor
   *
   * @param App\Services\Params\GradePratiquantService $service
   *
   */
  public function __construct(GradePratiquantService $service)
  {
      $this->service = $service;
  }

   /**
    * Retourne les associations.
    *
    * @return \Illuminate\Http\Response
   */
   public function index(){
       $grades = $this->service->allFormatted();

       return Inertia::render('App/Params/Pratiquant/Grade', [
           'grades' => $grades,
       ]);
   }

   /**
    * Ajouter un grade.
    *
    * @param  App\Http\Requests\Params\GradePratiquantRequest $request
    * @return \Illuminate\Http\Response
   */
   public function store(GradePratiquantRequest $request)
   {
       try {
           $result['data'] = $this->service->add($request);
       } catch (Exception $e) {
           $result = [
               'status' => 500,
               'error' => $e->getMessage()
           ];
       }

       return Redirect::route('pratiquant.grade.index');
   }

   /**
    * Metre à jour un grade.
    *
    * @param  App\Http\Requests\Params\GradePratiquantRequest  $request
    * @param  int $id
    * @return \Illuminate\Http\Response
   */
   public function update($id, GradePratiquantRequest $request){
       $grade = GradePratiquant::findOrFail($id) ;

       $grade->update([
           'libelle' => $request->libelle,
           'sigle' => $request->sigle,
           'age_min' => $request->age_min,
           'age_max' => $request->age_max,
           'active' => $request->active,
           'niveau' => $request->niveau
       ]);

       return Redirect::route('pratiquant.grade.index');
   }

   /**
    * Supprimer un grade.
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
   */
   public function destroy($id){
       $grade = GradePratiquant::findOrFail($id);

       //$grade->delete();

       return Redirect::route('pratiquant.grade.index');
   }
}
