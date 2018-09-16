<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="userscrollsofmagic")
 */
class Userscrollsofmagic {

    /**
     * @var integer
     *
     * @ORM\Column(name="iduserscrollsofmagic", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iduserscrollsofmagic;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=255, nullable=false)
     */
    private $user_email;

    /**
     * @ORM\Column(name="scrollsofmagicId", type="integer")  
     */
    private $scrollsofmagicId;

    /**
     * @ORM\Column(name="scrollsofmagicCount")  
     */
    private $scrollsofmagicCount;

    public function getIduserscrollsofmagic() {
        return $this->iduserscrollsofmagic;
    }

    public function setIduserscrollsofmagic($iduserscrollsofmagic) {
        $this->iduserscrollsofmagic = $iduserscrollsofmagic;
    }

    public function getUserEmail() {
        return $this->user_email;
    }

    public function setUserEmail($user_email) {
        $this->user_email = $user_email;
    }

    public function getScrollsofmagicId() {
        return $this->scrollsofmagicId;
    }

    public function setScrollsofmagicId($scrollsofmagicId) {
        $this->scrollsofmagicId = $scrollsofmagicId;
    }

    public function getScrollsofmagicCount() {
        return $this->scrollsofmagicCount;
    }

    public function setScrollsofmagicCount($scrollsofmagicCount) {
        $this->scrollsofmagicCount = $scrollsofmagicCount;
    }

}


