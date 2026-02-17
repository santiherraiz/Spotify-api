<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;

use Doctrine\ORM\Mapping as ORM;

/**
 * Configuracion
 *
 * @ORM\Table(name="configuracion", uniqueConstraints={@ORM\UniqueConstraint(name="usuario_id_UNIQUE", columns={"usuario_id"})}, indexes={@ORM\Index(name="fk_configuracion_idioma1_idx", columns={"idioma_id"}), @ORM\Index(name="fk_configuracion_calidad1_idx", columns={"calidad_id"}), @ORM\Index(name="fk_configuracion_tipo_descarga1_idx", columns={"tipo_descarga_id"})})
 * @ORM\Entity
 */
class Configuracion
{
    /**
     * @var bool
     *
     * @ORM\Column(name="autoplay", type="boolean", nullable=false)
     * 
     * @Groups({"configuracion:read", "configuracion:write"})
     */
    private $autoplay;

    /**
     * @var bool
     *
     * @ORM\Column(name="ajuste", type="boolean", nullable=false)
     * 
     * @Groups({"configuracion:read", "configuracion:write"})
     */
    private $ajuste;

    /**
     * @var bool
     *
     * @ORM\Column(name="normalizacion", type="boolean", nullable=false)
     * 
     * @Groups({"configuracion:read", "configuracion:write"})
     */
    private $normalizacion;

    /**
     * @var Calidad
     *
     * @ORM\ManyToOne(targetEntity="Calidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="calidad_id", referencedColumnName="id")
     * })
     * 
     * @Groups({"configuracion:read", "configuracion:write"})
     */
    private $calidad;

    /**
     * @var TipoDescarga
     *
     * @ORM\ManyToOne(targetEntity="TipoDescarga")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_descarga_id", referencedColumnName="id")    
     * })
     * 
     * @Groups({"configuracion:read", "configuracion:write"})
     */
    private $tipoDescarga;

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
     */
    private $usuario;

    /**
     * @var Idioma
     *
     * @ORM\ManyToOne(targetEntity="Idioma")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idioma_id", referencedColumnName="id")
     * })
     * 
     * @Groups({"configuracion:read", "configuracion:write"})
     */
    private $idioma;



    /**
     * Get autoplay
     *
     * @return bool
     */
    public function getAutoplay()
    {
        return $this->autoplay;
    }

    /**
     * Set autoplay
     *
     * @param bool $autoplay
     *
     * @return self
     */
    public function setAutoplay($autoplay)
    {
        $this->autoplay = $autoplay;

        return $this;
    }

    /**
     * Get ajuste
     *
     * @return bool
     */
    public function getAjuste()
    {
        return $this->ajuste;
    }

    /**
     * Set ajuste
     *
     * @param bool $ajuste
     *
     * @return self
     */
    public function setAjuste($ajuste)
    {
        $this->ajuste = $ajuste;

        return $this;
    }

    /**
     * Get normalizacion
     *
     * @return bool
     */
    public function getNormalizacion()
    {
        return $this->normalizacion;
    }

    /**
     * Set normalizacion
     *
     * @param bool $normalizacion
     *
     * @return self
     */
    public function setNormalizacion($normalizacion)
    {
        $this->normalizacion = $normalizacion;

        return $this;
    }

    /**
     * Get calidad
     *
     * @return mixed
     */
    public function getCalidad()
    {
        return $this->calidad;
    }

    /**
     * Set calidad
     *
     * @param mixed $calidad
     *
     * @return self
     */
    public function setCalidad($calidad)
    {
        $this->calidad = $calidad;

        return $this;
    }

    /**
     * Get tipoDescarga
     *
     * @return mixed
     */
    public function getTipoDescarga()
    {
        return $this->tipoDescarga;
    }

    /**
     * Set tipoDescarga
     *
     * @param mixed $tipoDescarga
     *
     * @return self
     */
    public function setTipoDescarga($tipoDescarga)
    {
        $this->tipoDescarga = $tipoDescarga;

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
     * Get idioma
     *
     * @return mixed
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * Set idioma
     *
     * @param mixed $idioma
     *
     * @return self
     */
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;

        return $this;
    }
}
