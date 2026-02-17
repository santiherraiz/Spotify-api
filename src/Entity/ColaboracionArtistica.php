<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * ColaboracionArtistica
 *
 * @ORM\Table(name="colaboracion_artistica", indexes={@ORM\Index(name="fk_colaboracion_artistica_artista2_idx", columns={"artista_colaborador_id"}), @ORM\Index(name="fk_colaboracion_artistica_artista1_idx", columns={"artista_id"}), @ORM\Index(name="fk_colaboracion_artistica_cancion1_idx", columns={"cancion_id"})})
 * @ORM\Entity
 */
class ColaboracionArtistica
{
    /**
     * @var Cancion
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Cancion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cancion_id", referencedColumnName="id")
     * })
     */
    private $cancion;

    /**
     * @var Artista
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Artista")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="artista_colaborador_id", referencedColumnName="id")
     * })
     */
    private $artistaColaborador;

    /**
     * @var Artista
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Artista")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="artista_id", referencedColumnName="id")
     * })
     */
    private $artista;



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
     * Get artistaColaborador
     *
     * @return mixed
     */
    public function getArtistaColaborador()
    {
        return $this->artistaColaborador;
    }

    /**
     * Set artistaColaborador
     *
     * @param mixed $artistaColaborador
     *
     * @return self
     */
    public function setArtistaColaborador($artistaColaborador)
    {
        $this->artistaColaborador = $artistaColaborador;

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
}
