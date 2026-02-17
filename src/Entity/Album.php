<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Album
 *
 * @ORM\Table(name="album", indexes={@ORM\Index(name="fk_album_artista1_idx", columns={"artista_id"}), @ORM\Index(name="titulo_idx", columns={"titulo"}), @ORM\Index(name="patrocinado_idx", columns={"patrocinado"}), @ORM\Index(name="anyo_idx", columns={"anyo"})})
 * @ORM\Entity
 */
class Album
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @Groups({"album:read", "cancion:read_detail"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=100, nullable=false)
     * 
     * @Groups({"album:read", "cancion:read_detail"})
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=false)
     * 
     * @Groups({"album:read"})
     */
    private $imagen;

    /**
     * @var bool
     *
     * @ORM\Column(name="patrocinado", type="boolean", nullable=false)
     * 
     * @Groups({"album:read"})
     */
    private $patrocinado;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_inicio_patrocinio", type="date", nullable=true)
     */
    private $fechaInicioPatrocinio;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_fin_patrocinio", type="date", nullable=true)
     */
    private $fechaFinPatrocinio;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="anyo", type="datetime", nullable=true)
     * 
     * @Groups({"album:read"})
     */
    private $anyo;

    /**
     * @var Artista
     *
     * @ORM\ManyToOne(targetEntity="Artista")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="artista_id", referencedColumnName="id")
     * })
     * 
     * @Groups({"album:read_detail"})
     */
    private $artista;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Usuario", mappedBy="album")
     */
    private $usuario = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->usuario = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return self
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get patrocinado
     *
     * @return bool
     */
    public function getPatrocinado()
    {
        return $this->patrocinado;
    }

    /**
     * Set patrocinado
     *
     * @param bool $patrocinado
     *
     * @return self
     */
    public function setPatrocinado($patrocinado)
    {
        $this->patrocinado = $patrocinado;

        return $this;
    }

    /**
     * Get fechaInicioPatrocinio
     *
     * @return \DateTime|null
     */
    public function getFechaInicioPatrocinio()
    {
        return $this->fechaInicioPatrocinio;
    }

    /**
     * Set fechaInicioPatrocinio
     *
     * @param \DateTime|null $fechaInicioPatrocinio
     *
     * @return self
     */
    public function setFechaInicioPatrocinio($fechaInicioPatrocinio)
    {
        $this->fechaInicioPatrocinio = $fechaInicioPatrocinio;

        return $this;
    }

    /**
     * Get fechaFinPatrocinio
     *
     * @return \DateTime|null
     */
    public function getFechaFinPatrocinio()
    {
        return $this->fechaFinPatrocinio;
    }

    /**
     * Set fechaFinPatrocinio
     *
     * @param \DateTime|null $fechaFinPatrocinio
     *
     * @return self
     */
    public function setFechaFinPatrocinio($fechaFinPatrocinio)
    {
        $this->fechaFinPatrocinio = $fechaFinPatrocinio;

        return $this;
    }

    /**
     * Get anyo
     *
     * @return \DateTime|null
     */
    public function getAnyo()
    {
        return $this->anyo;
    }

    /**
     * Set anyo
     *
     * @param \DateTime|null $anyo
     *
     * @return self
     */
    public function setAnyo($anyo)
    {
        $this->anyo = $anyo;

        return $this;
    }

    /**
     * Get artista
     *
     * @return mixed
     */
    public function getArtista()
    {
        return $this->artista;
    }

    /**
     * Set artista
     *
     * @param mixed $artista
     *
     * @return self
     */
    public function setArtista($artista)
    {
        $this->artista = $artista;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set usuario
     *
     * @param \Doctrine\Common\Collections\Collection $usuario
     *
     * @return self
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }
}
