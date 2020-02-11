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

            $film_validator = Validator::make($key, [
                'film_id'       => 'required|unique:films',
                'opening_crawl' => 'required',
                'director'      => 'required',
                'producer'      => 'required',
                'release_date'  => 'required',
                'characters'    => 'required'
            ]);

            // this is to pull all characters under that film

            foreach($key['characters'] as $people_url){

                $key['people_id'] = explode('/', $people_url)[5];

                $validator = Validator::make($key, [
                    'people_id' => 'required|unique:peoples',
                ]);

                if(!$validator->fails()) {
                    $people_ids[] = $this->insert_people($people_url,$key['people_id']);
                }
            }

            if(!$film_validator->fails()) {

                $fields[] = $this->films_fields($key,$key['film_id']);
            }
        }
        
        // Films::insert($fields); //Inserting Data in Bulk
        
        Films::insert($fields);
 
        $response['status'] = (!empty($fields)) ? true : false; //Setting Response Status
        $response['message'] = ($response['status']) ? "New Rows Inserted successfully" : "Data Synced Successfully"; //Setting Response Message
        
        return Response::json($response);
    }

    public function savePeoples(Request $request){
        
        $data =  $request->all();
        $fields = array();
        
        foreach($data as $key){
            
            $key['people_id'] = ($key['url']) ? explode('/', $key['url'])[5] : null;
            // only taking Id from URl to check if it is unique

            $people_validator = Validator::make($key, [
                'people_id'     => 'required|unique:peoples',
                'name'          => 'required',
                'birth_year'    => 'required',
                'eye_color'     => 'required',
                'gender'        => 'required',
                'hair_color'    => 'required',
                'skin_color'    => 'required',
                'films'         => 'required'
            ]);
            
            // this is to pull all films under that character

            foreach($key['films'] as $flim_url){

                $key['film_id'] = explode('/', $flim_url)[5];

                $validator = Validator::make($key, [
                    'film_id' => 'required|unique:films',
                ]);

                if(!$validator->fails()) {
                    
                    $this->insert_films($flim_url,$key['film_id']);
                    
                }
            }

            if(!$people_validator->fails()) {
                
                $fields[] = $this->people_fields($key,$key['people_id']);
            }
        }

        Peoples::insert($fields);

        $response['status'] = (!empty($fields)) ? true : false; //Setting Response Status
        $response['message'] = ($response['status']) ? "New Rows Inserted successfully" : "Data Synced successfully"; //Setting Response Message
        
        return Response::json($response);
    }

    private function insert_people($url,$people_id){
        
        $key = json_decode(file_get_contents($url),true);

        $fields[] =  $this->people_fields($key,$people_id);
        
        Peoples::insert($fields); //Inserting Data in Bulk

        return $people_id;
    }

    private function insert_films($url,$film_id){
        
        $key = json_decode(file_get_contents($url),true);

        $fields[] =  $this->films_fields($key,$film_id);

        Films::insert($fields); //Inserting Data in Bulk

        return $film_id;
    }

    private function people_fields($key = array(),$people_id){
        
        if(empty($key)) return $array();
        
        return  array(
                    "people_id"     => $people_id,
                    "name"          => $key['name'],
                    "birth_year"    => $key['birth_year'],
                    "eye_color"     => $key['eye_color'],
                    "gender"        => $key['gender'],
                    "hair_color"    => $key['hair_color'],
                    "skin_color"    => $key['skin_color'],
                    'films'         => json_encode($key['films'])
                );

    }

    private function films_fields($key = array(),$film_id){
        
        if(empty($key)) return $array();

        return  array(
                    "title"         => $key['title'],
                    "film_id"       => $film_id,
                    "opening_crawl" => $key['opening_crawl'],
                    "director"      => $key['director'],
                    "producer"      => $key['producer'],
                    "release_date"  => $key['release_date'],
                    'characters'    => json_encode($key['characters'])
                );

    }
}
