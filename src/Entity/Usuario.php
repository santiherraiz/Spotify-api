<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", uniqueConstraints={@ORM\UniqueConstraint(name="username_UNIQUE", columns={"username"}), @ORM\UniqueConstraint(name="email_UNIQUE", columns={"email"})})
 * @ORM\Entity
 */
class Usuario
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * 
     * @Groups({"usuario:read"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=45, nullable=false)
     * 
     * @Groups({"usuario:read", "usuario:write"})
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=150, nullable=false)
     * 
     * @Groups({"usuario:write"})
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=150, nullable=false)
     * 
     * @Groups({"usuario:read", "usuario:write"})
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="genero", type="string", length=1, nullable=true)
     * 
     * @Groups({"usuario:read", "usuario:write"})
     */
    private $genero;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     * 
     * @Groups({"usuario:write"})
     */
    private $fechaNacimiento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pais", type="string", length=45, nullable=true)
     * 
     * @Groups({"usuario:read", "usuario:write"})
     */
    private $pais;

    /**
     * @var string|null
     *
     * @ORM\Column(name="codigo_postal", type="string", length=20, nullable=true)
     * 
     * @Groups({"usuario:read", "usuario:write"})
     */
    private $codigoPostal;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Cancion", inversedBy="usuario")
     * @ORM\JoinTable(name="guarda_cancion",
     *   joinColumns={
     *     @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="cancion_id", referencedColumnName="id")
     *   }
     * )
     * 
     */
    private $cancion = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Podcast", inversedBy="usuario")
     * @ORM\JoinTable(name="podcast_usuario",
     *   joinColumns={
     *     @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="podcast_id", referencedColumnName="id")
     *   }
     * )
     */
    private $podcast = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Album", inversedBy="usuario")
     * @ORM\JoinTable(name="sigue_album",
     *   joinColumns={
     *     @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="album_id", referencedColumnName="id")
     *   }
     * )
     */
    private $album = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Artista", inversedBy="usuario")
     * @ORM\JoinTable(name="sigue_artista",
     *   joinColumns={
     *     @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="artista_id", referencedColumnName="id")
     *   }
     * )
     */
    private $artista = array();

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Playlist", inversedBy="usuarioSeguidor")
     * @ORM\JoinTable(name="sigue_playlist",
     *   joinColumns={
     *     @ORM\JoinColumn(name="usuario_seguidor_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="playlist_id", referencedColumnName="id")
     *   }
     * )
     */
    private $playlist = array();

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cancion = new \Doctrine\Common\Collections\ArrayCollection();
        $this->podcast = new \Doctrine\Common\Collections\ArrayCollection();
        $this->album = new \Doctrine\Common\Collections\ArrayCollection();
        $this->artista = new \Doctrine\Common\Collections\ArrayCollection();
        $this->playlist = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get genero
     *
     * @return string|null
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set genero
     *
     * @param string|null $genero
     *
     * @return self
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get fechaNacimiento
     * 
     *
     * @return string|null
     * @Groups({"usuario:read"})
     * 
     * @SerializedName("fechaNacimiento")
     */
    public function getFechaNacimiento(): ?string
    {
        return $this->fechaNacimiento ? $this->fechaNacimiento->format('d/m/Y') : null;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return self
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string|null
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set pais
     *
     * @param string|null $pais
     *
     * @return self
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get codigoPostal
     *
     * @return string|null
     */
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    /**
     * Set codigoPostal
     *
     * @param string|null $codigoPostal
     *
     * @return self
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;

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

    /**
     * Get album
     *
     * @return mixed
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Set album
     *
     * @param mixed $album
     *
     * @return self
     */
    public function setAlbum($album)
    {
        $this->album = $album;

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
