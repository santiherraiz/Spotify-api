<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Premium
 *
 * @ORM\Table(name="premium", indexes={@ORM\Index(name="fk_premium_usuario1_idx", columns={"usuario_id"}), @ORM\Index(name="fecha_renovacion_idx", columns={"fecha_renovacion"})})
 * @ORM\Entity
 */
class Premium
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_renovacion", type="date", nullable=false)
     * 
     * @Groups({"plan:read"})
     */
    private $fechaRenovacion;

    /**
     * @var Usuario
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     * 
     * @Groups({"plan:read"})
     */
    private $usuario;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Cancion", mappedBy="premiumUsuario")
     */
    private $cancion = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cancion = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get fechaRenovacion
     *
     * @return \DateTime
     */
    public function getFechaRenovacion()
    {
        return $this->fechaRenovacion;
    }

    /**
     * Set fechaRenovacion
     *
     * @param \DateTime $fechaRenovacion
     *
     * @return self
     */
    public function setFechaRenovacion($fechaRenovacion)
    {
        $this->fechaRenovacion = $fechaRenovacion;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set usuario
     *
     * @param mixed $usuario
     *
     * @return self
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get cancion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCancion()
    {
        return $this->cancion;
    }

    /**
     * Set cancion
     *
     * @param \Doctrine\Common\Collections\Collection $cancion
     *
     * @return self
     */
    public function setCancion($cancion)
    {
        $this->cancion = $cancion;

        return $this;
    }
}
