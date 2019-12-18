<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pacijent;
use Illuminate\support\Facades\DB;

class PacijentController extends Controller
{
    function index()
    {
      $data = DB::table('pacijent')->get();
     return view('pacijenti', ['data'=>$data]);
    }
    public function forma_osoba_nova() {
      return view('forma', ['pacijent'=>new Pacijent()]);
   }

   public function forma_osoba_stara($id){
      $pacijent = Pacijent::findOrFail($id);
      return view('forma', compact('pacijent'));//['osoba'=>$osoba]);
      //where('id', $id)->get();
      //find($id);
          //where('ime', 'LIKE', '%'.$vr.'%')

      //
   }
  public function osoba_nova(Request $request){
      //return $request->all();
      $d = new Pacijent();
      $d->ime_pacijenta = $request->ime_pacijenta;
      $d->prezime_pacijenta = $request->prezime_pacijenta;
      $d->email_pacijenta = $request->email_pacijenta;
      $d->datum_rodjenja = $request->datum_rodjenja;
      $d->pol = $request->pol;
      $d->adresa = $request->adresa;
      $d->dodeljeni_lekar_id = $request->dodeljeni_lekar_id;
      $d->datum_dodele_lekara = $request->datum_dodele_lekara;
      $d->lbo = $request->lbo;
      $d->save();
      return redirect()->to('/tabela');
   }
   public function osoba_update(Request $request){
      //return $request->all();
      $d = Pacijent::find($request->pacijent_id);
      $d->ime_pacijenta = $request->ime_pacijenta;
      $d->prezime_pacijenta = $request->prezime_pacijenta;
      $d->email_pacijenta = $request->email_pacijenta;
      $d->datum_rodjenja = $request->datum_rodjenja;
      $d->pol = $request->pol;
      $d->adresa = $request->adresa;
      $d->dodeljeni_lekar_id = $request->dodeljeni_lekar_id;
      $d->datum_dodele_lekara = $request->datum_dodele_lekara;
      $d->lbo = $request->lbo;
      $d->save();
      return redirect()->to('/tabela');
    }
    public function osoba_delete($id){
      $pacijent = Pacijent::find($id);
      $pacijent->delete();
      return redirect()->to('/tabela');
   }

    function action(Request $request)
    {
     //if($request->ajax())
     //{
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
        $data = DB::table('pacijent')
        ->where('ime_pacijenta', 'like', '%'.$query.'%')
        ->orWhere('prezime_pacijenta', 'like', '%'.$query.'%')
        ->orWhere('email_pacijenta', 'like', '%'.$query.'%')
        ->orWhere('datum_rodjenja', 'like', '%'.$query.'%')
        ->orWhere('adresa', 'like', '%'.$query.'%')
        ->orWhere('lbo', 'like', '%'.$query.'%')
        ->orderBy('pacijent_id', 'desc')
        ->get();
         
      }
      else
      {
       $data = DB::table('pacijent')
         ->orderBy('pacijent_id', 'desc')
         ->get();
      }

      return view('pacijenti', ['data'=>$data]);
    // }else{
    //   return 'NEMA AJAX';
    // }
    }
}
