<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="listtournament")
 */
class Listtournament {

    /**
     * @var integer
     *
     * @ORM\Column(name="idlisttournament", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idlisttournament;

    /**
     * @ORM\Column(name="datelisttournament")
     */
    private $datelisttournament;

    /**
     * @ORM\Column(name="nametournament")  
     */
    private $nametournament;

    /**
     * @ORM\Column(name="maxcountlisttournament")  
     */
    private $maxcountlisttournament;
    
    /**
     * @ORM\Column(name="prizefund")  
     */
    private $prizefund;
    
    /**
     * @ORM\Column(name="costofregistration")  
     */
    private $costofregistration;



    public function getIdlisttournament() {
        return $this->idlisttournament;
    }

    public function setIdlisttournament($idlisttournament) {
        $this->idlisttournament = $idlisttournament;
    }

    public function getDatelisttournament() {
        return $this->datelisttournament;
    }

    public function setDatelisttournament($datelisttournament) {
        $this->datelisttournament = $datelisttournament;
    }

    public function getNametournament() {
        return $this->nametournament;
    }

    public function setNametournament($nametournament) {
        $this->nametournament = $nametournament;
    }

    public function getMaxcountlisttournament() {
        return $this->maxcountlisttournament;
    }

    public function setMaxcountlisttournament($maxcountlisttournament) {
        $this->maxcountlisttournament = $maxcountlisttournament;
    }
    
    
    public function getPrizefund() {
        return $this->prizefund;
    }

    public function setPrizefund($prizefund) {
        $this->prizefund = $prizefund;
    }
    
    public function getCostofregistration() {
        return $this->costofregistration;
    }
    
    public function setCostofregistration($costofregistration) {
        $this->costofregistration = $costofregistration;
    }

}


