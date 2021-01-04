<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AdafruitController extends Controller
{
    public function get_bano(){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('keyada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-bano');
        return $response;
    }

public function get_cocina(){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('keyada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-cocina');
        return $response;
    }

public function get_oficina(){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('keyada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-oficina');
        return $response;
    }

public function get_cuarto(){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('keyada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-cuarto');
        return $response;
    }

public function get_sala(){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('keyada')
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-sala');
        return $response;
    }


    public function led_bano(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('keyada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-bano/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    public function led_cocina(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('keyada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-cocina/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    public function led_cuarto(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('keyada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-cuarto/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    public function led_oficina(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('keyada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-oficina/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    public function led_sala(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('keyada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-sala/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    //TEMPERATURA Y HUMEDAD

    public function gettemperatura(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('keyada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.temperaturavalue');
        return $response;
    }

    public function gethumedad(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('keyada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.humedad');
        return $response;
    }

    //ALARMA
    public function alarmahumo(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('keyada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.alarmahumo/data',[
            'value'=>'0'
        ]);
        return $response;
    }

    //FOCO EXTERNO

    public function getfocoexterno(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('keyada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.focoexterno');
        return $response;
    }

    public function postfocoexterno(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('keyada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.focoexterno/data',[
            'value'=>$request->value
        ]);
        return $response;
    }


    //COCHERA
    public function cochera(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('keyada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.cochera/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    public function getcochera(){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('keyada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.cochera');
        
        return $response;
    }

}
