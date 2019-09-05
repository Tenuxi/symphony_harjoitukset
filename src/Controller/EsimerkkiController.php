<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class EsimerkkiController{

    //Kontrollerit laitetaan tänne
    public function laskePalkka(){
        $nettopalkka = 4500 * 0.7;

        //pyydetään Response oliota näyttämään tulos
        return new Response('<h2>Brutto palkkari on 4500 ja nettopalkkasi on <strong>' . $nettopalkka . '</strong></h2>');
    }

    public function tarkistaKarkausvuosi(){
        $vuosi = rand(1900, 2020);

        if ($vuosi % 4 == 0) {
            return new Response('Vuosi: ' . $vuosi . ' on karkausvuosi'); 
        } else {
            return new Response('Vuosi: ' . $vuosi . ' ei ole karkausvuosi');
        }
    }

    public function laskePH(){
        $x = 2.13*pow(10,-5);
        $ph = -log10($x);

        return new Response('<h3>kun vesiliuoksen vetyionikonsenraatio on 2.13 * 10(-5)mol/l sen pH on: ' . number_format($ph,1) );
    }

    public function heitaNoppaa(){
        $noppa = rand(1, 6);

        return new Response('Nopan silmä luku on: ' . $noppa);
    }

    public function naytaJSON(){
        //taulukko
        $nimet = [
            'Etunimi' => 'Pekka',
            'Sukunimi' => 'Kekkonen',
        ];
        //response olio näyttää tuloksen
        return new JsonResponse($nimet);

    }

}



?>