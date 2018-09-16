<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="scrollsofmagic")
 */
class ScrollsOfMagic {

    /**
     * @var integer
     *
     * @ORM\Column(name="idScrollsOfMagic", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idScrollsOfMagic;

    /**
     * @var string
     *
     * @ORM\Column(name="NameScrollsOfMagic", type="string", length=255, nullable=false)
     */
    private $NameScrollsOfMagic;

    /**
     * @var string
     *
     * @ORM\Column(name="CostScrollsOfMagic")
     */
    private $CostScrollsOfMagic;

    /**
     * @ORM\Column(name="LostScrollsOfMagic")  
     */
    private $LostScrollsOfMagic;

    /**
     * @ORM\Column(name="AttackScrollsOfMagic")  
     */
    private $AttackScrollsOfMagic;

    /**
     * @ORM\Column(name="DeffenceScrollsOfMagic")  
     */
    private $DeffenceScrollsOfMagic;

    /**
     * @ORM\Column(name="ImgScrollsOfMagic")  
     */
    private $ImgScrollsOfMagic;

    /**
     * @ORM\Column(name="scrollsofmagicMP")  
     */
    private $scrollsofmagicMP;

    public function getidScrollsOfMagic() {
        return $this->idScrollsOfMagic;
    }

    public function setidScrollsOfMagic($idScrollsOfMagic) {
        $this->idScrollsOfMagic = $idScrollsOfMagic;
    }

    public function getNameScrollsOfMagic() {
        return $this->NameScrollsOfMagic;
    }

    public function setNameScrollsOfMagic($NameScrollsOfMagic) {
        $this->NameScrollsOfMagic = $NameScrollsOfMagic;
    }

    public function getCostScrollsOfMagic() {
        return $this->CostScrollsOfMagic;
    }

    public function setCostScrollsOfMagic($CostScrollsOfMagic) {
        $this->CostScrollsOfMagic = $CostScrollsOfMagic;
    }

    public function getLostScrollsOfMagic() {
        return $this->LostScrollsOfMagic;
    }

    public function setLostScrollsOfMagic($LostScrollsOfMagic) {
        $this->LostScrollsOfMagic = $LostScrollsOfMagic;
    }

    public function getAttackScrollsOfMagic() {
        return $this->AttackScrollsOfMagic;
    }

    public function setAttackScrollsOfMagic($AttackScrollsOfMagic) {
        $this->AttackScrollsOfMagic = $AttackScrollsOfMagic;
    }

    public function getDeffenceScrollsOfMagic() {
        return $this->DeffenceScrollsOfMagic;
    }

    public function setDeffenceScrollsOfMagic($DeffenceScrollsOfMagic) {
        $this->DeffenceScrollsOfMagic = $DeffenceScrollsOfMagic;
    }

    public function getImgScrollsOfMagic() {
        return $this->ImgScrollsOfMagic;
    }

    public function setImgScrollsOfMagic($ImgScrollsOfMagic) {
        $this->ImgScrollsOfMagic = $ImgScrollsOfMagic;
    }
    
    public function getScrollsofmagicMP() {
        return $this->scrollsofmagicMP;
    }
    
    public function setScrollsofmagicMP($scrollsofmagicMP) {
        $this->scrollsofmagicMP = $scrollsofmagicMP;
    }

}
