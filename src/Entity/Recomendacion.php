<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecomendacionRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Recomendacion
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $estudiante;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $cantidad;

    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    private $desempeno;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $cualidades;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $recomendacion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $otros;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

     /**
     * One Registro has One Recomendacion.
     * @ORM\OneToOne(targetEntity="Registro", inversedBy="recomendacion")
     * @ORM\JoinColumn(name="registro_id", referencedColumnName="id")
     */
    private $registro;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstudiante(): ?string
    {
        return $this->estudiante;
    }

    public function setEstudiante(string $estudiante): self
    {
        $this->estudiante = $estudiante;

        return $this;
    }

    public function getCantidad(): ?string
    {
        return $this->cantidad;
    }

    public function setCantidad(?string $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getDesempeno(): ?string
    {
        return $this->desempeno;
    }

    public function setDesempeno(?string $desempeno): self
    {
        $this->desempeno = $desempeno;

        return $this;
    }

    public function getCualidades(): ?string
    {
        return $this->cualidades;
    }

    public function setCualidades(?string $cualidades): self
    {
        $this->cualidades = $cualidades;

        return $this;
    }

    public function getRecomendacion(): ?string
    {
        return $this->recomendacion;
    }

    public function setRecomendacion(?string $recomendacion): self
    {
        $this->recomendacion = $recomendacion;

        return $this;
    }

    public function getOtros(): ?string
    {
        return $this->otros;
    }

    public function setOtros(?string $otros): self
    {
        $this->otros = $otros;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getRegistro()
    {
        return $this->registro;
    }

    /**
     * @param mixed $registro
     */
    public function setRegistro($registro)
    {
        $this->registro = $registro;
    }

}
