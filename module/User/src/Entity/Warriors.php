<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="warriors")
 */
class Warriors {

    /**
     * @var integer
     *
     * @ORM\Column(name="idwarriors", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idwarriors;

    /**
     * @var string
     *
     * @ORM\Column(name="namewarriors", type="string", length=255, nullable=false)
     */
    private $namewarriors;

    /**
     * @var string
     *
     * @ORM\Column(name="costwarriors")
     */
    private $costwarriors;

    /**
     * @ORM\Column(name="lostwarriors")  
     */
    private $lostwarriors;

    /**
     * @ORM\Column(name="attackwarriors")  
     */
    private $attackwarriors;

    /**
     * @ORM\Column(name="deffencewarriors")  
     */
    private $deffencewarriors;

    /**
     * @ORM\Column(name="imgwarriors")  
     */
    private $imgwarriors;

    /**
     * @ORM\Column(name="hplifewarriors")  
     */
    private $hplifewarriors;

    public function getIdwarriors() {
        return $this->idwarriors;
    }

    public function setIdwarriors($idwarriors) {
        $this->idwarriors = $idwarriors;
    }

    public function getNamewarriors() {
        return $this->namewarriors;
    }

    public function setNamewarriors($namewarriors) {
        $this->namewarriors = $namewarriors;
    }

    public function getCostwarriors() {
        return $this->costwarriors;
    }

    public function setCostwarriors($costwarriors) {
        $this->costwarriors = $costwarriors;
    }

    public function getLostwarriors() {
        return $this->lostwarriors;
    }

    public function setLostwarriors($lostwarriors) {
        $this->lostwarriors = $lostwarriors;
    }

    public function getAttackwarriors() {
        return $this->attackwarriors;
    }

    public function setAttackwarriors($attackwarriors) {
        $this->attackwarriors = $attackwarriors;
    }

    public function getDeffencewarriors() {
        return $this->deffencewarriors;
    }

    public function setDeffencewarriors($deffencewarriors) {
        $this->deffencewarriors = $deffencewarriors;
    }

    public function getImgwarriors() {
        return $this->imgwarriors;
    }

    public function setImgwarriors($imgwarriors) {
        $this->imgwarriors = $imgwarriors;
    }
    
    public function getHplifewarriors() {
        return $this->hplifewarriors;
    }
    
    public function setHplifewarriors($hplifewarriors) {
        $this->hplifewarriors = $hplifewarriors;
    }

}
