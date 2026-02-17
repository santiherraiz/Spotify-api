<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * AnyadeCancionPlaylist
 *
 * @ORM\Table(name="anyade_cancion_playlist", indexes={@ORM\Index(name="fk_anyade_cancion_playlist_cancion1_idx", columns={"cancion_id"}), @ORM\Index(name="fk_anyade_cancion_playlist_playlist1_idx", columns={"playlist_id"}), @ORM\Index(name="fk_anyade_cancion_playlist_usuario1_idx", columns={"usuario_id"}), @ORM\Index(name="fecha_anyadida", columns={"fecha_anyadida"})})
 * @ORM\Entity
 */
class AnyadeCancionPlaylist
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_anyadida", type="datetime", nullable=false)
     * 
     * @Groups({"playlist:canciones"})
     */
    private $fechaAnyadida;

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
     * @var Cancion
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Cancion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cancion_id", referencedColumnName="id")
     * })
     * 
     * @Groups({"playlist:canciones"})
     */
    private $cancion;

    /**
     * @var Usuario
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;



    /**
     * Get fechaAnyadida
     *
     * @return \DateTime
     */
    public function getFechaAnyadida()
    {
        return $this->fechaAnyadida;
    }

    /**
     * Set fechaAnyadida
     *
     * @param \DateTime $fechaAnyadida
     *
     * @return self
     */
    public function setFechaAnyadida($fechaAnyadida)
    {
        $this->fechaAnyadida = $fechaAnyadida;

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

    /**
     * Get cancion
     *
     * @return mixed
     */
    public function getCancion()
    {
        return $this->cancion;
    }

    /**
     * Set cancion
     *
     * @param mixed $cancion
     *
     * @return self
     */
    public function setCancion($cancion)
    {
        $this->cancion = $cancion;

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
