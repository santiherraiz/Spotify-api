<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Capitulo
 *
 * @ORM\Table(name="capitulo", indexes={@ORM\Index(name="fk_capitulo_podcast1_idx", columns={"podcast_id"}), @ORM\Index(name="titulo", columns={"titulo"}), @ORM\Index(name="fecha", columns={"fecha"})})
 * @ORM\Entity
 */
class Capitulo
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @Groups({"capitulo:read"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=100, nullable=false)
     * 
     * @Groups({"capitulo:read"})
     */
    private $titulo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     * 
     * @Groups({"capitulo:read"})
     */
    private $descripcion;

    /**
     * @var int
     *
     * @ORM\Column(name="duracion", type="integer", nullable=false, options={"unsigned"=true})
     * 
     * @Groups({"capitulo:read"})
     */
    private $duracion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     * 
     * @Groups({"capitulo:read"})
     */
    private $fecha;

    /**
     * @var int
     *
     * @ORM\Column(name="numero_reproducciones", type="integer", nullable=false, options={"unsigned"=true})
     * 
     * @Groups({"capitulo:read"})
     */
    private $numeroReproducciones;

    /**
     * @var Podcast
     *
     * @ORM\ManyToOne(targetEntity="Podcast")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="podcast_id", referencedColumnName="id")
     * })
     * 
     * @Groups({"capitulo:read_detail"})
     */
    private $podcast;



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
     * Get descripcion
     *
     * @return string|null
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set descripcion
     *
     * @param string|null $descripcion
     *
     * @return self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get duracion
     *
     * @return mixed
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set duracion
     *
     * @param mixed $duracion
     *
     * @return self
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get numeroReproducciones
     *
     * @return mixed
     */
    public function getNumeroReproducciones()
    {
        return $this->numeroReproducciones;
    }

    /**
     * Set numeroReproducciones
     *
     * @param mixed $numeroReproducciones
     *
     * @return self
     */
    public function setNumeroReproducciones($numeroReproducciones)
    {
        $this->numeroReproducciones = $numeroReproducciones;

        return $this;
    }

    /**
     * Get podcast
     *
     * @return mixed
     */
    public function getPodcast()
    {
        return $this->podcast;
    }

    /**
     * Set podcast
     *
     * @param mixed $podcast
     *
     * @return self
     */
    public function setPodcast($podcast)
    {
        $this->podcast = $podcast;

        return $this;
    }
}
