<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="siegeweapons")
 */
class SiegeWeapons {

    /**
     * @var integer
     *
     * @ORM\Column(name="idSiegeWeapons", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSiegeWeapons;

    /**
     * @var string
     *
     * @ORM\Column(name="NameSiegeWeapons", type="string", length=255, nullable=false)
     */
    private $NameSiegeWeapons;

    /**
     * @var string
     *
     * @ORM\Column(name="CostSiegeWeapons")
     */
    private $CostSiegeWeapons;

    /**
     * @ORM\Column(name="LostSiegeWeapons")  
     */
    private $LostSiegeWeapons;

    /**
     * @ORM\Column(name="AttackSiegeWeapons")  
     */
    private $AttackSiegeWeapons;

    /**
     * @ORM\Column(name="DeffenceSiegeWeapons")  
     */
    private $DeffenceSiegeWeapons;

    /**
     * @ORM\Column(name="ImgSiegeWeapons")  
     */
    private $ImgSiegeWeapons;

    public function getidSiegeWeapons() {
        return $this->idSiegeWeapons;
    }

    public function setidSiegeWeapons($idSiegeWeapons) {
        $this->idSiegeWeapons = $idSiegeWeapons;
    }

    public function getNameSiegeWeapons() {
        return $this->NameSiegeWeapons;
    }

    public function setNameSiegeWeapons($NameSiegeWeapons) {
        $this->NameSiegeWeapons = $NameSiegeWeapons;
    }

    public function getCostSiegeWeapons() {
        return $this->CostSiegeWeapons;
    }

    public function setCostSiegeWeapons($CostSiegeWeapons) {
        $this->CostSiegeWeapons = $CostSiegeWeapons;
    }

    public function getLostSiegeWeapons() {
        return $this->LostSiegeWeapons;
    }

    public function setLostSiegeWeapons($LostSiegeWeapons) {
        $this->LostSiegeWeapons = $LostSiegeWeapons;
    }

    public function getAttackSiegeWeapons() {
        return $this->AttackSiegeWeapons;
    }

    public function setAttackSiegeWeapons($AttackSiegeWeapons) {
        $this->AttackSiegeWeapons = $AttackSiegeWeapons;
    }

    public function getDeffenceSiegeWeapons() {
        return $this->DeffenceSiegeWeapons;
    }

    public function setDeffenceSiegeWeapons($DeffenceSiegeWeapons) {
        $this->DeffenceSiegeWeapons = $DeffenceSiegeWeapons;
    }

    public function getImgSiegeWeapons() {
        return $this->ImgSiegeWeapons;
    }

    public function setImgSiegeWeapons($ImgSiegeWeapons) {
        $this->ImgSiegeWeapons = $ImgSiegeWeapons;
    }

}
