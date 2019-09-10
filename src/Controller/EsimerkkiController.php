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

    public function lihapiirakka(){
        $lompakkonrahat = rand(1, 10);
        $piirakka = 2.5;

        echo ('Lomapakossa on rahaa: ' . $lompakkonrahat . '<br>' . 'Piirakka maksaa: ' . $piirakka . '<br>');

        if($lompakkonrahat >= $piirakka){
            $lompakkonrahat -= $piirakka;
            return new Response ("Lompakossa on oston jälkeen rahaa: " . $lompakkonrahat);
            echo "rahaa oli ostaa lihapiirakka";
        }else{
            return new Response ("Taidat alkaa paastoamaan.");
        }

    }


    /**
     * @Route(esimerkki/"esim7")
     */
    public function laskePakkaspaivat(){
        //muuttujat
        $summa = 0;
        $pakkaspaivat = 0;
        $tekija = "Joonas Aaltonen";
        $mittausviikko = 30;
        $keskiarvo1 = 0;
        $keskiarvo2 = 0;


        //lämpötila taulukko
        $pakkasasteet = [
            'ma' => 3,
            'ti' => -1,
            'ke' => -10,
            'to' => 1,
            'pe' => 0,
            'la' => 7,
            'su' => -3,
        ];

        //lasketaan pakkaspäivien summa
        foreach ($pakkasasteet as $pakkaspaivat) {
            if ($pakkasaste < 0) {
                $summa += $pakkasaste;
                $pakkaspaivat += 1;
            }
        }

        //lasketaan pakkaspäivien keskiarvo
        $keskiarvo1 = number_format(($summa / $pakkaspaivat), 1);

        //lasketaan koko viikon keskilämpötila
        $keskiarvo2 = number_format(array_sum($pakkasasteet) / count($pakkasasteet), 1);

        //kutsutaan näkymää ja lähetetään sille dataa siltävät muuttujat
        return $this->render('esimerkit/pakkasasteet.html.twig', [
            'pakkasasteet' => $pakkasasteet,
            'keskiarvo1' => $keskiarvo1,
            'keskiarvo2' => $keskiarvo2,
            'viikko' => $mittausviikko,
            'tekija' => $tekija
        ]);

    }
    

}



?>