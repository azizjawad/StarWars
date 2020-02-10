<?php

namespace App\Http\Controllers;

use App\Models\Films;
use App\Models\Peoples;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class Home extends Controller
{
    public function index(){
        return view('index');
    }

    public function saveFilms(Request $request){
        $data =  $request->all();
        $fields = array();
        foreach($data as $key){
            $key['film_id'] = ($key['url']) ? explode('/', $key['url'])[5] : null;
            // only taking Id from URl to check if it is unique

            $validator = Validator::make($key, [
                'film_id'       => 'required|unique:films',
                'opening_crawl' => 'required',
                'director'      => 'required',
                'producer'      => 'required',
                'release_date'  => 'required',
                'characters'    => 'required',
            ]);
            if(!$validator->fails()) {
                $fields[] = array(
                    "title"         => $key['title'],
                    "film_id"       => $key['film_id'],
                    "opening_crawl" => $key['opening_crawl'],
                    "director"      => $key['director'],
                    "producer"      => $key['producer'],
                    "release_date"  => $key['release_date'],
                    "characters"    => json_encode($key['characters'])
                );
            }
        }

        Films::insert($fields); //Inserting Data in Bulk
        $response['status'] = (!empty($fields)) ? true : false; //Setting Response Status
        $response['message'] = ($response['status']) ? "Data Inserted successfully" : "Data Already Exits"; //Setting Response Message
        return Response::json($response);
    }

    public function savePeoples(Request $request){
        $data =  $request->all();
        $fields = array();
        foreach($data as $key){
            $key['people_id'] = ($key['url']) ? explode('/', $key['url'])[5] : null;
            // only taking Id from URl to check if it is unique

            $validator = Validator::make($key, [
                'people_id'     => 'required|unique:peoples',
                'name'          => 'required',
                'birth_year'    => 'required',
                'eye_color'     => 'required',
                'gender'        => 'required',
                'hair_color'    => 'required',
                'skin_color'    => 'required',
                'films'         => 'required',
            ]);
            if(!$validator->fails()) {
                $fields[] = array(
                    "people_id"     => $key['people_id'],
                    "name"          => $key['name'],
                    "birth_year"    => $key['birth_year'],
                    "eye_color"     => $key['eye_color'],
                    "gender"        => $key['gender'],
                    "hair_color"    => $key['hair_color'],
                    "skin_color"    => $key['skin_color'],
                    "films"         => json_encode($key['films'])
                );
            }
        }

        Peoples::insert($fields); //Inserting Data in Bulk
        $response['status'] = (!empty($fields)) ? true : false; //Setting Response Status
        $response['message'] = ($response['status']) ? "Data Inserted successfully" : "Data Already Exits"; //Setting Response Message
        return Response::json($response);
    }

}
