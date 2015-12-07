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
     * @ORM\Column(type="datetime")
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
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="TypeFormation")
     * @ORM\JoinColumn(name="type", referencedColumnName="id")
     */
    protected $type;
}