<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peoples;
use App\Models\Films;


class Listing extends Controller
{
    //

    public function index(){
        $data['peoples'] = Peoples::all();
        $data['films'] = Films::all();
        return view('listing',$data);
    }

    public function people_listing($id){
        
        $people = Peoples::where('people_id',$id)->first();
        if(empty($people)) return redirect('listing');
        foreach(json_decode($people->films,true) as $film_url){
             $film_ids[] = explode('/', $film_url)[5];
        }

        if(!empty($film_ids)) $films = Films::whereIn('film_id', $film_ids)->get();
        
        return view('people_listing')->with(['people' => $people,'films' => $films]);
    }
    public function film_listing($id){
        
        $film = Films::where('film_id',$id)->first();
        if(empty($film)) return redirect('listing');
        foreach(json_decode($film->characters,true) as $people_url){
             $people_ids[] = explode('/', $people_url)[5];
        }

        if(!empty($people_ids)) $peoples = Peoples::whereIn('people_id', $people_ids)->get();
        
        return view('flim_listing')->with(['peoples' => $peoples,'film' => $film]);
    }
}
