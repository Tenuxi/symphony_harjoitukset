<?php

namespace App\Entity;

class Henkilo{

    private $etunimi;
    private $sukunimi;
    private $email;
    private $kirjauspvm;



    public function getEtunimi(){
        return $this->etunimi;
    }
    public function setEtunimi($_etunimi){
        $this->etunimi = $_etunimi;
    }

    public function getSukunimi(){
        return $this->sukunimi;
    }
    public function setSukunimi($_sukunimi){
        $this->sukunimi = $_sukunimi;
    }

    public function getEmail(){
        return $this->email;
    }
    public function setEmail($_email){
        $this->email = $_email;
    }

    public function setKirjauspvm(\DateTimeInterface $kirjauspvm){
        $this->Kirjauspvm = $kirjauspvm;
    }
    public function getKirjauspvm(){
        return $this->kirjauspvm;
    }


}
?>
