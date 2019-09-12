<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EsimerkkiController extends AbstractController{

    /**
     * @Route("esimerkki/esim1")
     */
    //Kontrollerit laitetaan tänne
    public function laskePalkka(){
        $nettopalkka = 4500 * 0.7;

        //pyydetään Response oliota näyttämään tulos
        //return new Response('<h2>Brutto palkkari on 4500 ja nettopalkkasi on <strong>' . $nettopalkka . '</strong></h2>');

        return $this->render('esimerkit/laskepalkka.html.twig', [
            'nettopalkka' => $nettopalkka
        ]);
    }


    /**
     * @Route("esimerkki/esim2")
     */
    public function tarkistaKarkausvuosi(){
        $vuosi = rand(1900, 2020);
        $tokateksti = " ei ole karkausvuosi";
        $teksti = " on karkausvuosi";


        if ($vuosi % 4 == 0) {
            //return new Response('Vuosi: ' . $vuosi . ' on karkausvuosi'); 
            return $this->render('esimerkit/tarkistakarkausvuosi.html.twig',[
                'vuosi' => $vuosi,
                'teksti' => $teksti
            ]);
        } else {
            $teksti = $tokateksti;
            //return new Response('Vuosi: ' . $vuosi . ' ei ole karkausvuosi');
            return $this->render('esimerkit/tarkistakarkausvuosi.html.twig',[
                'vuosi' => $vuosi,
                'teksti' => $teksti
            ]);
        }
    }


    /**
     * @Route("esimerkki/esim3")
     */
    public function laskePH(){
        $x = 2.13*pow(10,-5);
        $ph = -log10($x);

        $laskettu = number_format($ph,1);
        //return new Response('<h3>kun vesiliuoksen vetyionikonsenraatio on 2.13 * 10(-5)mol/l sen pH on: ' . number_format($ph,1) );
        return $this->render('esimerkit/laskeph.html.twig',[
            'laskettu' => $laskettu
        ]);

    }


    /**
     * @Route("esimerkki/esim4")
     */
    public function heitaNoppaa(){
        $noppa = rand(1, 6);

        //return new Response('Nopan silmä luku on: ' . $noppa);
        return $this->render('esimerkit/heitanoppaa.html.twig',[
            'noppa' => $noppa
        ]);
    }


    /**
     * @Route("esimerkki/esim5")
     */
    public function naytaJSON(){
        //taulukko
        $nimet = [
            'Etunimi' => 'Pekka',
            'Sukunimi' => 'Kekkonen',
        ];
        //response olio näyttää tuloksen
       // return new JsonResponse($nimet);
        return $this->render('esimerkit/naytajson.html.twig',[
            'etunimi' => $nimet['Etunimi'],
            'sukunimi' => $nimet['Sukunimi'],
            'json' => new JsonResponse($nimet)
        ]);

    }


    /**
     * @Route("esimerkki/esim6")
     */
    public function lihapiirakka(){
        $lompakkonrahat = rand(1, 10);
        $piirakka = 2.5;

        $teksti1 = "Lompakossa on oston jälkeen rahaa: ";
        $teksti2 = "Taidat alkaa paastoamaan.";
        $teksti3 = "Rahaa oli ostaa lihis.";


        //echo ('Lomapakossa on rahaa: ' . $lompakkonrahat . '<br>' . 'Piirakka maksaa: ' . $piirakka . '<br>');

        if($lompakkonrahat >= $piirakka){
            $lompakkonrahat -= $piirakka;
            //return new Response ("Lompakossa on oston jälkeen rahaa: " . $lompakkonrahat);
            return $this->render('esimerkit/lihapiirakka.html.twig', [
                'lompakossarahaa' => $lompakkonrahat
            ]);
        }else{
            //return new Response ("Taidat alkaa paastoamaan.");
            return $this->render('esimerkit/lihapiirakka2.html.twig',[

            ]);
        }

    }

    /**
     * @Route("esimerkki/esim7")
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
        foreach ($pakkasasteet as $pakkasaste) {
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

    /**
    * @Route("/esimerkit/uutiset/{slug}")
     */
    public function nayta($slug){
        $kommentit = [
            'Muropaketin arvostelun mukaan Control on viiden tähden täysosuma!',
            'Apple Arcade toimii iPhoneilla ja iPadeillä sekä Macilla ja Apple TV:llä!',
            'PlayStation Blog on jälleen listannut viikon suurimmat PS4-julkaisut!'
    ];
        return $this->render('esimerkit/nayta.html.twig',[
            'otsikko' => $slug,
            'kommentit' => $kommentit
        ]);
    }
    

    /**
     * @Route("esimerkki/esim8/{slug}")
     */
    //Kontrollerit laitetaan tänne
    public function laskePalkka2($slug){
        $bruttopalkka = $nettopalkka * 0.7;
        
        return $this->render('esimerkit/laskepalkka2.html.twig', [
            'nettopalkka' => $nettopalkka,
            'bruttopalkka' => $slug
        ]);
    }

    /**
     * @Route("esimerkki/esim9")
     */

    public function kuntopisteet(){

        $holkkapts = 4;
        $hiihtopts = 2;
        $kavelypts = 1;



        $nimi = 'Arvid Lee';


        //taulukko
        $liikunta = [
            'Holkka' => 10,
            'Hiihto' => 5,
            'Kävely' => 20,
        ];

        //laskurit

            //pisteet liikutataulukko * pistemäärä
        $pisteetholkka = $liikunta['Holkka'] * $holkkapts;
        $pisteethiihto = $liikunta['Hiihto'] * $hiihtopts;
        $pisteetkavely = $liikunta['Kävely'] * $kavelypts;

            //Yhteenlasketut pisteet
        $pisteetyhteensa = $pisteetholkka + $pisteethiihto + $pisteetkavely;

        //tulostin
        return $this->render('esimerkit/kuntopisteet.html.twig',[
            'nimi' => $nimi,
            'holkka' => $liikunta['Holkka'],
            'holkkapisteet' => $pisteetholkka,
            'hiihto' => $liikunta['Hiihto'],
            'hiihtopisteet' => $pisteethiihto,
            'kavely' => $liikunta['Kävely'],
            'kavelypisteet' => $pisteetkavely,
            'pisteet' => $pisteetyhteensa,
        ]);


    }

}



?>