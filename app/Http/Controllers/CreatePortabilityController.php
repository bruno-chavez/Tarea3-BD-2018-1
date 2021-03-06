<?php

namespace App\Http\Controllers;

use Auth;
use App\Division;
use App\Portability;

class CreatePortabilityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showPortabilityForm () {

        foreach(Portability::all() as $port) {
            if($port->user_id == Auth::id()) {
                session()->flash('wrong', 'Tienes una portabilidad pendiente.');
                return redirect(route('user.dashboard'));
            }
        }

        return view('auth.portability');
    }

    public function create() {

        $user = Auth::user();
        $new_division = Division::where('division_name', request('division'))->first();

        $queryFields = [];
        $queryFields = array_add($queryFields, 'user_id', $user->id);
        $queryFields = array_add($queryFields, 'old_division_id', $user->division->id);
        $queryFields = array_add($queryFields, 'new_division_id', $new_division->id);
        Portability::create($queryFields);

        session()->flash('message', 'Petición de portabilidad creada exitosamente.');

        return redirect(route('user.dashboard'));
    }

}
