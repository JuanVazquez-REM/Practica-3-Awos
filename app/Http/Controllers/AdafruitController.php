<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AdafruitController extends Controller
{
    public function led_bano(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_JwKR01g4EFRFra1IHYMlgVCfXPK5',
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-bano/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    public function led_cocina(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_JwKR01g4EFRFra1IHYMlgVCfXPK5',
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-cocina/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    public function led_cuarto(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_JwKR01g4EFRFra1IHYMlgVCfXPK5',
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-cuarto/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    public function led_oficina(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_JwKR01g4EFRFra1IHYMlgVCfXPK5',
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-oficina/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    public function led_sala(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_JwKR01g4EFRFra1IHYMlgVCfXPK5',
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.led-sala/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    //TEMPERATURA Y HUMEDAD

    public function gettemperatura(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_JwKR01g4EFRFra1IHYMlgVCfXPK5',
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.temperaturavalue');
        return $response;
    }

    public function gethumedad(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_JwKR01g4EFRFra1IHYMlgVCfXPK5',
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.humedad');
        return $response;
    }

    //ALARMA
    public function alarmahumo(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_JwKR01g4EFRFra1IHYMlgVCfXPK5',
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.alarmahumo/data',[
            'value'=>'0'
        ]);
        return $response;
    }

    //FOCO EXTERNO

    public function getfocoexterno(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_JwKR01g4EFRFra1IHYMlgVCfXPK5',
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.focoexterno');
        return $response;
    }

    public function postfocoexterno(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_JwKR01g4EFRFra1IHYMlgVCfXPK5',
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.focoexterno/data',[
            'value'=>$request->value
        ]);
        return $response;
    }


    //COCHERA
    public function cochera(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_JwKR01g4EFRFra1IHYMlgVCfXPK5',
        ])->post('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.cochera/data',[
            'value'=>$request->value
        ]);
        return $response;
    }

    public function getcochera(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_JwKR01g4EFRFra1IHYMlgVCfXPK5',
        ])->get('https://io.adafruit.com/api/v2/JuanVazquez/feeds/proyectofinal.cochera');
        return $response;
    }
}
