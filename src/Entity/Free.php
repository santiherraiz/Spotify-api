<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Free
 *
 * @ORM\Table(name="free", indexes={@ORM\Index(name="fk_free_usuario1_idx", columns={"usuario_id"}), @ORM\Index(name="fecha_revision_idx", columns={"fecha_revision"})})
 * @ORM\Entity
 */
class Free
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_revision", type="date", nullable=false)
     * 
     * @Groups({"plan:read"})
     */
    private $fechaRevision;

    /**
     * @var int
     *
     * @ORM\Column(name="tiempo_publicidad", type="integer", nullable=false, options={"default"="600"})
     * 
     * @Groups({"plan:read"})
     */
    private $tiempoPublicidad = 600;

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
     * Get fechaRevision
     *
     * @return \DateTime
     */
    public function getFechaRevision()
    {
        return $this->fechaRevision;
    }

    /**
     * Set fechaRevision
     *
     * @param \DateTime $fechaRevision
     *
     * @return self
     */
    public function setFechaRevision($fechaRevision)
    {
        $this->fechaRevision = $fechaRevision;

        return $this;
    }

    /**
     * Get tiempoPublicidad
     *
     * @return mixed
     */
    public function getTiempoPublicidad()
    {
        return $this->tiempoPublicidad;
    }

    /**
     * Set tiempoPublicidad
     *
     * @param mixed $tiempoPublicidad
     *
     * @return self
     */
    public function setTiempoPublicidad($tiempoPublicidad)
    {
        $this->tiempoPublicidad = $tiempoPublicidad;

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
}
