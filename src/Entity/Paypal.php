<?php

namespace App\Entity;



use Doctrine\ORM\Mapping as ORM;

/**
 * Paypal
 *
 * @ORM\Table(name="paypal", uniqueConstraints={@ORM\UniqueConstraint(name="username_paypal_UNIQUE", columns={"username_paypal"})}, indexes={@ORM\Index(name="fk_paypal_forma_pago1_idx", columns={"forma_pago_id"})})
 * @ORM\Entity
 */
class Paypal
{
    /**
     * @var string
     *
     * @ORM\Column(name="username_paypal", type="string", length=150, nullable=false)
     */
    private $usernamePaypal;

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
     * Get usernamePaypal
     *
     * @return string
     */
    public function getUsernamePaypal()
    {
        return $this->usernamePaypal;
    }

    /**
     * Set usernamePaypal
     *
     * @param string $usernamePaypal
     *
     * @return self
     */
    public function setUsernamePaypal($usernamePaypal)
    {
        $this->usernamePaypal = $usernamePaypal;

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
