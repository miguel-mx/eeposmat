<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recomendacion
 *
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="recomendacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RecomendacionRepository")
 */
class Recomendacion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="recomendacion", type="text")
     */
    private $recomendacion;

    /**
     * One Recomendacion has One Registro.
     * @ORM\OneToOne(targetEntity="Registro", inversedBy="recomendacion")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $registro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="date")
     */
    private $createdAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set recomendacion
     *
     * @param string $recomendacion
     *
     * @return Recomendacion
     */
    public function setRecomendacion($recomendacion)
    {
        $this->recomendacion = $recomendacion;

        return $this;
    }

    /**
     * Get recomendacion
     *
     * @return string
     */
    public function getRecomendacion()
    {
        return $this->recomendacion;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Recomendacion
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set registro
     *
     * @param \AppBundle\Entity\Registro $registro
     * @return Recomendacion
     */
    public function setRegistro(\AppBundle\Entity\Registro $registro = null)
    {
        $this->registro = $registro;
        return $this;
    }

    /**
     * Get registro
     *
     * @return \AppBundle\Entity\Registro
     */
    public function getRegistro()
    {
        return $this->registro;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }

}

