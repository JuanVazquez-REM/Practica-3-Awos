<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function word_all(Request $request){
        $request->validate([
            'word'=> 'required',
        ]);

        if($request->user()->tokenCan('user:user') || $request->user()->tokenCan('admin:admin')){
            $response = Http::withHeaders([
                'x-rapidapi-key' => '926216fe3dmsh98cf13dc97b12a2p13f477jsn2a9c69cc11bd',
                'x-rapidapi-host' => 'wordsapiv1.p.rapidapi.com'
            ])->get('https://wordsapiv1.p.rapidapi.com/words/'.$request->word);
    
            return $response;
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }


    
    public function definition(Request $request){
        $request->validate([
            'word'=> 'required',
        ]);

        if($request->user()->tokenCan('user:user') || $request->user()->tokenCan('admin:admin')){
            $response = Http::withHeaders([
                'x-rapidapi-key' => '926216fe3dmsh98cf13dc97b12a2p13f477jsn2a9c69cc11bd',
                'x-rapidapi-host' => 'wordsapiv1.p.rapidapi.com'
            ])->get('https://wordsapiv1.p.rapidapi.com/words/'.$request->word.'/definitions');
    
            return $response;
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }


    public function word_examples(Request $request){
        $request->validate([
            'word'=> 'required',
        ]);

        if($request->user()->tokenCan('user:user') || $request->user()->tokenCan('admin:admin')){
            $response = Http::withHeaders([
                'x-rapidapi-key' => '926216fe3dmsh98cf13dc97b12a2p13f477jsn2a9c69cc11bd',
                'x-rapidapi-host' => 'wordsapiv1.p.rapidapi.com'
            ])->get('https://wordsapiv1.p.rapidapi.com/words/'.$request->word.'/examples');
    
            return $response;
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }

    public function word_region(Request $request){
        $request->validate([
            'word'=> 'required',
        ]);

        if($request->user()->tokenCan('user:user') || $request->user()->tokenCan('admin:admin')){
            $response = Http::withHeaders([
                'x-rapidapi-key' => '926216fe3dmsh98cf13dc97b12a2p13f477jsn2a9c69cc11bd',
                'x-rapidapi-host' => 'wordsapiv1.p.rapidapi.com'
            ])->get('https://wordsapiv1.p.rapidapi.com/words/'.$request->word.'/inRegion');
    
            return $response;
        }else{
            return abort(
                response()->json(['Message' => 'Unauthorized'], 401)
            );
        }
    }
}
