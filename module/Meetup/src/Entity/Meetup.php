<?php

declare(strict_types=1);

namespace Meetup\Entity;

use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Element\Date;

/**
 * Class Meetup
 *
 * Attention : Doctrine génère des classes proxy qui étendent les entités, celles-ci ne peuvent donc pas être finales !
 *
 * @package Application\Entity
 * @ORM\Entity(repositoryClass="\Meetup\Repository\MeetupRepository")
 * @ORM\Table(name="meetups")
 */
class Meetup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     **/
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=false)
     */

    private $description = '';

    /**
     * @ORM\Column(type="date", nullable=true)
     */

    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */

    private $endDate;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */


    private $organisateur;
    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */

    private $entreprise;

    /**
     * @ORM\Column(type="integer", length=11, nullable=false)
     */

    private $participant;

    /**
     * Meetup constructor.
     * @param $id
     * @param $title
     * @param string $description
     * @param $startDate
     * @param $endDate
     * @param $organisateur
     * @param $entreprise
     * @param $participant
     */

    public function __construct(string $title, string $description = '', string $organisateur = '', string $entreprise = '', date $startDate, date $endDate, int $participant)
    {
        $this->id = Uuid::uuid4()->toString();
        $this->title = $title;
        $this->description = $description;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->organisateur = $organisateur;
        $this->entreprise = $entreprise;
        $this->participant = $participant;
    }

    /**
     * @return mixed
     */
    public function getId() : ?string
    {
        return $this->id;
    }

    public function getStartDate() : ?date
    {
        return $this->startDate;
    }

    public function getEndDate() : ?date
    {
        return $this->endDate;
    }
    /**
     * @return mixed
     */
    public function getOrganisateur() : ?string
    {
        return $this->organisateur;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title) : void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description) : void
    {
        $this->description = $description;
    }

    /**
     * @param string $startDate
     */
    public function setStartDate(Date $startDate) : void
    {
        $this->startDate = $startDate;
    }

    /**
     * @param string $endDat
     */
    public function setEndDate(Date $endDate) : void
    {
        $this->endDate = $endDate;
    }

    /**
     * @param string $organisateur
     */
    public function setOrganisateur(string $organisateur) : void
    {
        $this->organisateur = $organisateur;
    }

    /**
     * @param string $entreprise
     */
    public function setEntreprise(string $entreprise) : void
    {
        $this->entreprise = $entreprise;
    }

    /**
     * @param string $participant
     */
    public function setParticipant(integer $participant) : integer
    {
        $this->participant = $participant;
    }

    /**
     * @return mixed
     */
    public function getEntreprise() : ?string
    {
        return $this->entreprise;
    }

    /**
     * @return mixed
     */
    public function getParticipant() : ?int
    {
        return $this->participant;
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

}
