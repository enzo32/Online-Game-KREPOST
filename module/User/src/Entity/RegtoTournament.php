<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="regtotournament")
 */
class RegtoTournament {

    /**
     * @var integer
     *
     * @ORM\Column(name="idregtotournament", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idregtotournament;

    /**
     * @var integer
     *
     * @ORM\Column(name="tournamentid", type="integer")
     */
    private $tournamentid;

    /**
     * @ORM\Column(name="usersemail")
     */
    private $usersemail;

    

    public function getIdregtotournament() {
        return $this->idregtotournament;
    }

    public function setIdregtotournament($idregtotournament) {
        $this->idregtotournament = $idregtotournament;
    }

    public function getTournamentid() {
        return $this->tournamentid;
    }

    public function setTournamentid($tournamentid) {
        $this->tournamentid = $tournamentid;
    }

    public function getUsersemail() {
        return $this->usersemail;
    }

    public function setUsersemail($usersemail) {
        $this->usersemail = $usersemail;
    }


}
