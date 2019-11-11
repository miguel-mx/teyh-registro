<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegistroRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 *
 */
class Registro
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $sexo;

    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\Email(
     *     message = "El correo '{{ value }}' no es válido.",
     *     checkMX = true
     * )
     */
    private $correo;

    /**
     * @ORM\Column(type="string", length=120)
     * @Assert\NotBlank
     */
    private $universidad;

    /**
     * @ORM\Column(type="string", length=40)
     * @Assert\NotBlank
     */
    private $semestre;

    /**
     * @ORM\Column(type="string", length=6)
     * @Assert\NotBlank
     */
    private $promedio;

    /**
     * @ORM\Column(type="string", length=120)
     * @Assert\NotBlank
     */
    private $profesor;

    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\Email(
     *     message = "El correo '{{ value }}' no es válido.",
     *     checkMX = true
     * )
     */
    private $correoProfesor;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $beca;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $restricciones;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $token;

    /**
     * @Vich\UploadableField(mapping="historial", fileNameProperty="historialName")
     * @Assert\NotBlank(groups={"registro"})
     * @Assert\File(
     *     maxSize = "2048k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     * @var File
     */
    private $historialFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $historialName;

    /**
     * @Vich\UploadableField(mapping="tarea", fileNameProperty="tareaName")
     * @Assert\File(
     *     maxSize = "2048k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Please upload a valid PDF"
     * )
     * @var File
     */
    private $tareaFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $tareaName;

    /**
     * One registro One Recomendacion
     * @ORM\OneToOne(targetEntity="Recomendacion", mappedBy="registro")
     */
    private $recomendacion;

    /**
     * @Gedmo\Slug(fields={"nombre", "apellidos"})
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="date")
     */
    private $created;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getUniversidad(): ?string
    {
        return $this->universidad;
    }

    public function setUniversidad(string $universidad): self
    {
        $this->universidad = $universidad;

        return $this;
    }

    public function getSemestre(): ?string
    {
        return $this->semestre;
    }

    public function setSemestre(string $semestre): self
    {
        $this->semestre = $semestre;

        return $this;
    }

    public function getPromedio(): ?string
    {
        return $this->promedio;
    }

    public function setPromedio(string $promedio): self
    {
        $this->promedio = $promedio;

        return $this;
    }

    public function getProfesor(): ?string
    {
        return $this->profesor;
    }

    public function setProfesor(string $profesor): self
    {
        $this->profesor = $profesor;

        return $this;
    }

    public function getCorreoProfesor(): ?string
    {
        return $this->correoProfesor;
    }

    public function setCorreoProfesor(string $correoProfesor): self
    {
        $this->correoProfesor = $correoProfesor;

        return $this;
    }

    public function getBeca(): ?string
    {
        return $this->beca;
    }

    public function setBeca(string $beca): self
    {
        $this->beca = $beca;

        return $this;
    }

    public function getRestricciones(): ?string
    {
        return $this->restricciones;
    }

    public function setRestricciones(?string $restricciones): self
    {
        $this->restricciones = $restricciones;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedValue()
    {
        $this->created = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function __toString()
    {
        return $this->nombre;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $historialFile
     */
    public function setHistorialFile(?File $historialFile = null): void
    {
        $this->historialFile = $historialFile;

        if (null !== $historialFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getHistorialFile(): ?File
    {
        return $this->historialFile;
    }

    public function setHistorialName(?string $historialName): void
    {
        $this->historialName = $historialName;
    }

    public function getHistorialName(): ?string
    {
        return $this->historialName;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $tareaFile
     */
    public function setTareaFile(?File $tareaFile = null): void
    {
        $this->tareaFile = $tareaFile;

        if (null !== $tareaFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getTareaFile(): ?File
    {
        return $this->tareaFile;
    }

    public function setTareaName(?string $tareaName): void
    {
        $this->tareaName = $tareaName;
    }

    public function getTareaName(): ?string
    {
        return $this->tareaName;
    }

    /**
     * @return mixed
     */
    public function getRecomendacion()
    {
        return $this->recomendacion;
    }

    /**
     * @param mixed $recomendacion
     */
    public function setRecomendacion($recomendacion)
    {
        $this->recomendacion = $recomendacion;
    }
}
