<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pokemon
 *
 * @ORM\Table(name="pokemon")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PokemonRepository")
 */
class Pokemon
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="species", type="integer")
     */
    private $species;

    /**
     * @var float
     *
     * @ORM\Column(name="height", type="float")
     */
    private $height;

    /**
     * @var float
     *
     * @ORM\Column(name="wieght", type="float")
     */
    private $wieght;

    /**
     * @var int
     *
     * @ORM\Column(name="baseExperience", type="integer")
     */
    private $baseExperience;

    /**
     * @var int
     *
     * @ORM\Column(name="order", type="integer")
     */
    private $order;

    /**
     * @var string
     *
     * @ORM\Column(name="default", type="string", length=255)
     */
    private $default;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Pokemon
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set species
     *
     * @param integer $species
     *
     * @return Pokemon
     */
    public function setSpecies($species)
    {
        $this->species = $species;

        return $this;
    }

    /**
     * Get species
     *
     * @return int
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * Set height
     *
     * @param float $height
     *
     * @return Pokemon
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get height
     *
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set wieght
     *
     * @param float $wieght
     *
     * @return Pokemon
     */
    public function setWieght($wieght)
    {
        $this->wieght = $wieght;

        return $this;
    }

    /**
     * Get wieght
     *
     * @return float
     */
    public function getWieght()
    {
        return $this->wieght;
    }

    /**
     * Set baseExperience
     *
     * @param integer $baseExperience
     *
     * @return Pokemon
     */
    public function setBaseExperience($baseExperience)
    {
        $this->baseExperience = $baseExperience;

        return $this;
    }

    /**
     * Get baseExperience
     *
     * @return int
     */
    public function getBaseExperience()
    {
        return $this->baseExperience;
    }

    /**
     * Set position
     *
     * @param integer $order
     *
     * @return Pokemon
     */
    public function setOrder($order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set isDefault
     *
     * @param string $default
     *
     * @return Pokemon
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return string
     */
    public function getDefault()
    {
        return $this->default;
    }
}

