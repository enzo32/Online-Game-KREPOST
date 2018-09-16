<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="gotobuttle")
 */
class Gotobuttle {

    /**
     * @var integer
     *
     * @ORM\Column(name="idgotobuttle", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idgotobuttle;

    /**
     * @ORM\Column(name="idtournament")
     */
    private $idtournament;

    /**
     * @ORM\Column(name="emailusers")  
     */
    private $emailusers;

    /**
     * @ORM\Column(name="prize")  
     */
    private $prize;
    
    /**
     * @ORM\Column(name="woninbuttle")  
     */
    private $woninbuttle;
    

    public function getIdgotobuttle() {
        return $this->idgotobuttle;
    }

    public function setIdgotobuttle($idgotobuttle) {
        $this->idgotobuttle = $idgotobuttle;
    }

    public function getIdtournament() {
        return $this->idtournament;
    }

    public function setIdtournament($idtournament) {
        $this->idtournament = $idtournament;
    }

    public function getEmailusers() {
        return $this->emailusers;
    }

    public function setEmailusers($emailusers) {
        $this->emailusers = $emailusers;
    }

    public function getPrize() {
        return $this->prize;
    }

    public function setPrize($prize) {
        $this->prize = $prize;
    }
    
    
    public function getWoninbuttle() {
        return $this->woninbuttle;
    }

    public function setWoninbuttle($woninbuttle) {
        $this->woninbuttle = $woninbuttle;
    }
    

}


