<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estructura
 *
 * @ORM\Table(name="estructura")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EstructuraRepository")
 */
class Estructura
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="codigo", type="integer", nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="contrato", type="string", length=100, nullable=false)
     */
    private $contrato;

    /**
     * @var string
     *
     * @ORM\Column(name="puesto", type="string", length=100, nullable=false)
     */
    private $puesto;

    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=100, nullable=false)
     */
    private $marca;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Marcas", mappedBy="estructura", cascade={"persist","remove"})
     */
    private $marcas;



    /**
     * Set codigo
     *
     * @param integer $codigo
     *
     * @return Estructura
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return integer
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set contrato
     *
     * @param string $contrato
     *
     * @return Estructura
     */
    public function setContrato($contrato)
    {
        $this->contrato = $contrato;

        return $this;
    }

    /**
     * Get contrato
     *
     * @return string
     */
    public function getContrato()
    {
        return $this->contrato;
    }

    /**
     * Set puesto
     *
     * @param string $puesto
     *
     * @return Estructura
     */
    public function setPuesto($puesto)
    {
        $this->puesto = $puesto;

        return $this;
    }

    /**
     * Get puesto
     *
     * @return string
     */
    public function getPuesto()
    {
        return $this->puesto;
    }

    /**
     * Set marca
     *
     * @param string $marca
     *
     * @return Estructura
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return string
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->marcas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add marca
     *
     * @param \AppBundle\Entity\Marcas $marca
     *
     * @return Estructura
     */
    public function addMarca(\AppBundle\Entity\Marcas $marca)
    {
        $this->marcas[] = $marca;

        return $this;
    }

    /**
     * Remove marca
     *
     * @param \AppBundle\Entity\Marcas $marca
     */
    public function removeMarca(\AppBundle\Entity\Marcas $marca)
    {
        $this->marcas->removeElement($marca);
    }

    /**
     * Get marcas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMarcas()
    {
        return $this->marcas;
    }
}
