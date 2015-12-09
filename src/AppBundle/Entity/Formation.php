<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Formation
 * @package AppBundle\Entity
 * @ORM\Entity
 * @ORM\Table
 */
class Formation {
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Column(type="date")
     */
    protected $date;

    /**
     * @ORM\ManyToOne(targetEntity="Antenne")
     * @ORM\JoinColumn(name="antenne", referencedColumnName="id")
     */
    protected $antenne;

    /**
     * @ORM\Column(type="string")
     * @todo user?
     */
    protected $formateur;

    /**
     * @ORM\Column(type="string")
     * @todo adresse?
     */
    protected $lieu;

    /**
     * @ORM\Column(type="text")
     */
    protected $description = "";

    /**
     * @ORM\ManyToOne(targetEntity="TypeFormation")
     * @ORM\JoinColumn(name="type", referencedColumnName="id")
     */
    protected $type;

    /**
     * @ORM\OneToMany(targetEntity="Stagiaire", mappedBy="formation")
     */
    protected $stagiaires;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getAntenne()
    {
        return $this->antenne;
    }

    /**
     * @param mixed $antenne
     */
    public function setAntenne($antenne)
    {
        $this->antenne = $antenne;
    }

    /**
     * @return mixed
     */
    public function getFormateur()
    {
        return $this->formateur;
    }

    /**
     * @param mixed $formateur
     */
    public function setFormateur($formateur)
    {
        $this->formateur = $formateur;
    }

    /**
     * @return mixed
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @param mixed $lieu
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getStagiaires()
    {
        return $this->stagiaires;
    }

    /**
     * @param mixed $stagiaires
     */
    public function setStagiaires($stagiaires)
    {
        $this->stagiaires = $stagiaires;
    }


}