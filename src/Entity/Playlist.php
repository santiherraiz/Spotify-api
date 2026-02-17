<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Playlist
 *
 * @ORM\Table(name="playlist", indexes={@ORM\Index(name="fk_playlist_usuario1_idx", columns={"usuario_id"})})
 * @ORM\Entity
 */
class Playlist
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @Groups({"playlist:read", "playlist:write"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=150, nullable=false)
     * 
     * @Groups({"playlist:read", "playlist:write"})
     */
    private $titulo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="numero_canciones", type="integer", nullable=true, options={"unsigned"=true})   
     * 
     * @Groups({"playlist:read", "playlist:write"})
     */
    private $numeroCanciones;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_creacion", type="date", nullable=true)
     * 
     * @Groups({"playlist:read", "playlist:write"})
     */
    private $fechaCreacion;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     * 
     * @Groups({"playlist:write"})
     */
    private $usuario;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="playlist")
     * 
     */
    private $usuarioSeguidor = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuarioSeguidor = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return self
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get numeroCanciones
     *
     * @return mixed
     */
    public function getNumeroCanciones()
    {
        return $this->numeroCanciones;
    }

    /**
     * Set numeroCanciones
     *
     * @param mixed $numeroCanciones
     *
     * @return self
     */
    public function setNumeroCanciones($numeroCanciones)
    {
        $this->numeroCanciones = $numeroCanciones;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime|null
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime|null $fechaCreacion
     *
     * @return self
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

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
     * Get usuarioSeguidor
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarioSeguidor()
    {
        return $this->usuarioSeguidor;
    }

    /**
     * Set usuarioSeguidor
     *
     * @param \Doctrine\Common\Collections\Collection $usuarioSeguidor
     *
     * @return self
     */
    public function setUsuarioSeguidor($usuarioSeguidor)
    {
        $this->usuarioSeguidor = $usuarioSeguidor;

        return $this;
    }
}
