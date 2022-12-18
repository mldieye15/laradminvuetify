<?php

namespace App\Http\Controllers\Federation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Federation\LigueRegionalRequest;
use App\Models\Federation\LigueRegionale;
use App\Services\Federation\FederationService;
use App\Services\Federation\LigueRegionaleService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LigueRegionalController extends Controller
{
   /**
    * @var service
   */
   protected $service;

   /**
    * @var fedeService
   */
  protected $fedeService;

   /**
    * FederationController Constructor
    *
    * @param App\Services\Federation\FederationService $fedeService
    * @param App\Services\Federation\LigueRegionaleService $service
    *
    */
   public function __construct(LigueRegionaleService $service, FederationService $fedeService )
   {
       $this->service = $service;
       $this->fedeService = $fedeService;
   }

    /**
     * Retourne les ligues régionales.
     *
     * @return \Illuminate\Http\Response
    */
    public function index(){
        //dd($this->fedeService->simplifiedFede()[0]['id']);
        $ligueRegionales = $this->service->allFormatted();

        return Inertia::render('App/Federation/LigueRegional/Index', [
            'ligueRegionales' => $ligueRegionales,
        ]);
    }

    /**
     * Retourne la page de création d'un nouveau régional.
     *  @return \Illuminate\Http\Response
    */
    public function create(){
        $regionSansLigRegio = $this->service->regionSansLigRegio();

        return Inertia::render('App/Federation/LigueRegional/New', [
            'regionSansLigRegio' => $regionSansLigRegio
        ]);
    }

    /**
     * Retourne la page de création d'un nouveau régional.
     *  @return \Illuminate\Http\Response
    */
    public function edit(Request $request){
        $ligueRegionale = $this->service->getByIdTransformed($request->ligue);

        return Inertia::render('App/Federation/LigueRegional/Edit', [
            'ligueRegionale' => $ligueRegionale
        ]);
    }

    /**
     * Retourne les ligues régionales.
     *
     *  @param $ligue
     *  @return \Illuminate\Http\Response
    */
    public function show($ligue){
        $ligueRegionale = $this->service->getById($ligue);

        return Inertia::render('App/Federation/LigueRegional/Details', [
            'ligueRegionale' => $ligueRegionale,
            'ligue' => $ligue,
        ]);
    }

    /**
     * Ajouter un ligue régional.
     *
     * @param  \App\Http\Requests\Federation\LigueRegionalRequest  $request
     * @return \Illuminate\Http\Response
    */
    public function store(LigueRegionalRequest $request)
    {
        $federation = $this->fedeService->simplifiedFede();
        try {
            $result['data'] = $this->service->add($request, $federation[0]['id']);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return Redirect::route('ligregio.index');
    }

    /**
     * Metre à jour un ligue régional.
     *
     * @param  \App\Http\Requests\Federation\LigueRegionalRequest  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
    */
    public function update($id, LigueRegionalRequest $request){
        $ligue = LigueRegionale::findOrFail($id) ;

        $map_path = $ligue->logo;
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => 'image|mimes:jpg,jpeg,png,svg|max:5120',
            ]);

            //  supression du map rataché autre que le map par défaut
            if($ligue->map != 'map-default.jpg'){
                Storage::delete('public/ligueregional/'.$ligue->map);
            }

            $map_path = $request->file('logo')->store('ligueregional', 'public');
            $map_path = (explode('ligueregional/', $map_path))[1];
        }

        try {
            //$result['data'] = $this->service->maj($request, $ligue);
            $ligue->update([
                'libelle' => $request->libelle,
                'sigle' => $request->sigle,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone,
                'email' => $request->email,
                'date_creation' => $request->date_creation,
                'page_web' => $request->page_web,
                'instagram' => $request->instagram,
                'logo' => $map_path
            ]);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return Redirect::route('ligregio.index');
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
            Storage::delete('public/ligueregional/'.$ligue->map);
        }

        $ligue->delete();

        return Redirect::route('ligregio.index');
    }
}
