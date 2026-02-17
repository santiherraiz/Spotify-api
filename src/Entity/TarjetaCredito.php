<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * TarjetaCredito
 *
 * @ORM\Table(name="tarjeta_credito", uniqueConstraints={@ORM\UniqueConstraint(name="numero_tarjeta_UNIQUE", columns={"numero_tarjeta"})}, indexes={@ORM\Index(name="fk_tarjeta_credito_forma_pago1_idx", columns={"forma_pago_id"})})
 * @ORM\Entity
 */
class TarjetaCredito
{
    /**
     * @var string
     *
     * @ORM\Column(name="numero_tarjeta", type="string", length=20, nullable=false)
     */
    private $numeroTarjeta;

    /**
     * @var bool
     *
     * @ORM\Column(name="mes_caducidad", type="boolean", nullable=false)
     */
    private $mesCaducidad;

    /**
     * @var int
     *
     * @ORM\Column(name="anyo_caducidad", type="integer", nullable=false)
     */
    private $anyoCaducidad;

    /**
     * @var int
     *
     * @ORM\Column(name="codigo_seguridad", type="smallint", nullable=false, options={"unsigned"=true})
     */
    private $codigoSeguridad;

    /**
     * @var FormaPago
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="FormaPago")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="forma_pago_id", referencedColumnName="id")
     * })
     */
    private $formaPago;



    /**
     * Get numeroTarjeta
     *
     * @return string
     */
    public function getNumeroTarjeta()
    {
        return $this->numeroTarjeta;
    }

    /**
     * Set numeroTarjeta
     *
     * @param string $numeroTarjeta
     *
     * @return self
     */
    public function setNumeroTarjeta($numeroTarjeta)
    {
        $this->numeroTarjeta = $numeroTarjeta;

        return $this;
    }

    /**
     * Get mesCaducidad
     *
     * @return bool
     */
    public function getMesCaducidad()
    {
        return $this->mesCaducidad;
    }

    /**
     * Set mesCaducidad
     *
     * @param bool $mesCaducidad
     *
     * @return self
     */
    public function setMesCaducidad($mesCaducidad)
    {
        $this->mesCaducidad = $mesCaducidad;

        return $this;
    }

    /**
     * Get anyoCaducidad
     *
     * @return \DateTime
     */
    public function getAnyoCaducidad()
    {
        return $this->anyoCaducidad;
    }

    /**
     * Set anyoCaducidad
     *
     * @param \DateTime $anyoCaducidad
     *
     * @return self
     */
    public function setAnyoCaducidad($anyoCaducidad)
    {
        $this->anyoCaducidad = $anyoCaducidad;

        return $this;
    }

    /**
     * Get codigoSeguridad
     *
     * @return mixed
     */
    public function getCodigoSeguridad()
    {
        return $this->codigoSeguridad;
    }

    /**
     * Set codigoSeguridad
     *
     * @param mixed $codigoSeguridad
     *
     * @return self
     */
    public function setCodigoSeguridad($codigoSeguridad)
    {
        $this->codigoSeguridad = $codigoSeguridad;

        return $this;
    }

    /**
     * Get formaPago
     *
     * @return mixed
     */
    public function getFormaPago()
    {
        return $this->formaPago;
    }

    /**
     * Set formaPago
     *
     * @param mixed $formaPago
     *
     * @return self
     */
    public function setFormaPago($formaPago)
    {
        $this->formaPago = $formaPago;

        return $this;
    }
}
