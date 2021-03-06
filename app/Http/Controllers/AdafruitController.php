<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AdafruitController extends Controller
{
    public function get_bano(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('ada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-bano');
        return $response;
    }

public function get_cocina(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('ada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-cocina');
        return $response;
    }

public function get_oficina(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('ada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-oficina');
        return $response;
    }

public function get_cuarto(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('ada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-cuarto');
        return $response;
    }

public function get_sala(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('ada')
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-sala');
        return $response;
    }

    //LEDS POST
    public function led_bano(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('ada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-bano/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    public function led_cocina(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('ada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-cocina/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    public function led_cuarto(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('ada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-cuarto/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    public function led_oficina(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('ada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-oficina/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    public function led_sala(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => $request->input('ada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-sala/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    //TEMPERATURA Y HUMEDAD

    public function gettemperatura(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('ada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.temperaturavalue');
        return $response;
    }

    public function gethumedad(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('ada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.humedad');
        return $response;
    }

    //ALARMA
    public function alarmahumo(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('ada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.alarmahumo/data',[
            'value'=>'OFF'
        ]);
        return $response; //comentario 
    }

    //FOCO EXTERNO

    public function getfocoexterno(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('ada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.focoexterno');
        return $response;
    }

    public function postfocoexterno(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('ada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.focoexterno/data',[
            'value'=>$request->value
        ]);
        return $response;
    }


    //COCHERA
    public function post_cochera(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('ada'),
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.cochera/data',[
            'value'=>$request->input('value')
        ]);
        return $response;
    }

    public function getcochera(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' =>$request->input('ada'),
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.cochera');
        
        return $response;
    }

}
