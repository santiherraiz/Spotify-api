<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * Favoritas
 *
 * @ORM\Table(name="favoritas", indexes={@ORM\Index(name="fk_favoritas_playlist1_idx", columns={"playlist_id"})})
 * @ORM\Entity
 */
class Favoritas
{
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
