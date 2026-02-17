<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * Patrocinada
 *
 * @ORM\Table(name="patrocinada", indexes={@ORM\Index(name="fk_patrocinada_playlist1_idx", columns={"playlist_id"})})
 * @ORM\Entity
 */
class Patrocinada
{
    /**
     * @var bool
     *
     * @ORM\Column(name="patrocinada", type="boolean", nullable=false, options={"default"="1"})
     */
    private $patrocinada = true;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @var Playlist
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Playlist")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="playlist_id", referencedColumnName="id")
     * })
     */
    private $playlist;



    /**
     * Get patrocinada
     *
     * @return mixed
     */
    public function getPatrocinada()
    {
        return $this->patrocinada;
    }

    /**
     * Set patrocinada
     *
     * @param mixed $patrocinada
     *
     * @return self
     */
    public function setPatrocinada($patrocinada)
    {
        $this->patrocinada = $patrocinada;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return self
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime|null
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime|null $fechaFin
     *
     * @return self
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get playlist
     *
     * @return mixed
     */
    public function getPlaylist()
    {
        return $this->playlist;
    }

    /**
     * Set playlist
     *
     * @param mixed $playlist
     *
     * @return self
     */
    public function setPlaylist($playlist)
    {
        $this->playlist = $playlist;

        return $this;
    }
}
