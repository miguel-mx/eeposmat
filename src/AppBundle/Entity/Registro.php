<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Registro
 *
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="registro")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RegistroRepository")
 * @Vich\Uploadable
 *
 */
class Registro
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
     * @ORM\Column(name="nombre", type="string", length=120)
     * @Assert\NotBlank(message="Please enter your name.")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apaterno", type="string", length=120)
     */
    private $apaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="amaterno", type="string", length=120)
     */
    private $amaterno;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=2)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=180)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=180)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=30)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=180)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     *
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="estatus", type="string", length=180)
     */
    private $estatus;

    /**
     * @var string
     *
     * @ORM\Column(name="universidad", type="string", length=255)
     */
    private $universidad;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="abstract", type="text", nullable=true)
     */
    private $abstract;

    /**
     * @var bool
     *
     * @ORM\Column(name="beca", type="boolean")
     */
    private $beca;

    /**
     * One Registro has One Recomendacion.
     * @ORM\OneToOne(targetEntity="Recomendacion", mappedBy="registro")
     */
    private $recomendacion;


    /**
     * @var string
     *
     * @ORM\Column(name="nombreProfesor", type="string", length=180, nullable=true)
     */
    private $nombreProfesor;

    /**
     * @var string
     *
     * @ORM\Column(name="emailProfesor", type="string", length=180, nullable=true)
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $emailProfesor;

    /**
     * @var string
     *
     * @ORM\Column(name="semestre", type="string", length=60)
     */
    private $semestre;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreEmergencia", type="string", length=180)
     */
    private $nombreEmergencia;

    /**
     * @var string
     *
     * @ORM\Column(name="telEmergencia", type="string", length=180)
     */
    private $telEmergencia;


    /**
     * @Vich\UploadableField(mapping="credencial", fileNameProperty="credencialName", nullable=true)
     *
     * @Assert\File(
     *     maxSize = "2048k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Favor de subir el archivo en formato PDF, no mayor a 2Mb"
     * )
     *
     * @var File
     */
    private $credencialFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $credencialName;

    /**
     * @Vich\UploadableField(mapping="historial", fileNameProperty="historialName", nullable=true)
     *
     * @Assert\File(
     *     maxSize = "2048k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Favor de subir el archivo en formato PDF, no mayor a 2Mb"
     * )
     *
     * @var File
     */
    private $historialFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $historialName;

    /**
     * @Vich\UploadableField(mapping="formato", fileNameProperty="formatoName", nullable=true)
     *
     * @Assert\File(
     *     maxSize = "2048k",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Favor de subir el archivo en formato PDF, no mayor a 2Mb"
     * )
     *
     * @var File
     */
    private $formatoFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $formatoName;


    /**
     * @var string
     * @Gedmo\Slug(fields={"nombre", "apaterno", "amaterno"}, updatable=false)
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

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
     * Set amaterno
     *
     * @param string $amaterno
     *
     * @return Registro
     */
    public function setAmaterno($amaterno)
    {
        $this->amaterno = $amaterno;

        return $this;
    }

    /**
     * Get amaterno
     *
     * @return string
     */
    public function getAmaterno()
    {
        return $this->amaterno;
    }

    /**
     * Set apaterno
     *
     * @param string $apaterno
     *
     * @return Registro
     */
    public function setApaterno($apaterno)
    {
        $this->apaterno = $apaterno;

        return $this;
    }

    /**
     * Get apaterno
     *
     * @return string
     */
    public function getApaterno()
    {
        return $this->apaterno;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Registro
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     *
     * @return Registro
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     *
     * @return Registro
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Registro
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Registro
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Registro
     */
    public function setEmail($email)
    {
        $this->email = $email;

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
     * Set estatus
     *
     * @param string $estatus
     *
     * @return Registro
     */
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * Get estatus
     *
     * @return string
     */
    public function getEstatus()
    {
        return $this->estatus;
    }

    /**
     * Set universidad
     *
     * @param string $universidad
     *
     * @return Registro
     */
    public function setUniversidad($universidad)
    {
        $this->universidad = $universidad;

        return $this;
    }

    /**
     * Get universidad
     *
     * @return string
     */
    public function getUniversidad()
    {
        return $this->universidad;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Registro
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set abstract
     *
     * @param string $abstract
     *
     * @return Registro
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
        return $this;
    }

    /**
     * Get abstract
     *
     * @return string
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set beca
     *
     * @param boolean $beca
     *
     * @return Registro
     */
    public function setBeca($beca)
    {
        $this->beca = $beca;

        return $this;
    }

    /**
     * Get beca
     *
     * @return bool
     */
    public function getBeca()
    {
        return $this->beca;
    }

    /**
     * Set recomendacion
     *
     * @param \AppBundle\Entity\Recomendacion $recomendacion
     * @return Registro
     */
    public function setRecomendacion(\AppBundle\Entity\Recomendacion $recomendacion = null)
    {
        $this->recomendacion = $recomendacion;
        return $this;
    }
    /**
     * Get recomendacion
     *
     * @return \AppBundle\Entity\Recomendacion
     */
    public function getRecomendacion()
    {
        return $this->recomendacion;
    }

    /**
     * Set nombreProfesor
     *
     * @param string $nombreProfesor
     *
     * @return Registro
     */
    public function setNombreProfesor($nombreProfesor)
    {
        $this->nombreProfesor = $nombreProfesor;

        return $this;
    }

    /**
     * Get nombreProfesor
     *
     * @return string
     */
    public function getNombreProfesor()
    {
        return $this->nombreProfesor;
    }

    /**
     * Set emailProfesor
     *
     * @param string $emailProfesor
     *
     * @return Registro
     */
    public function setEmailProfesor($emailProfesor)
    {
        $this->emailProfesor = $emailProfesor;

        return $this;
    }

    /**
     * Get emailProfesor
     *
     * @return string
     */
    public function getEmailProfesor()
    {
        return $this->emailProfesor;
    }

    /**
     * Set semestre
     *
     * @param string $semestre
     *
     * @return Registro
     */
    public function setSemestre($semestre)
    {
        $this->semestre = $semestre;

        return $this;
    }

    /**
     * Get semestre
     *
     * @return string
     */
    public function getSemestre()
    {
        return $this->semestre;
    }

    /**
     * Set nombreEmergencia
     *
     * @param string $nombreEmergencia
     *
     * @return Registro
     */
    public function setNombreEmergencia($nombreEmergencia)
    {
        $this->nombreEmergencia = $nombreEmergencia;

        return $this;
    }

    /**
     * Get nombreEmergencia
     *
     * @return string
     */
    public function getNombreEmergencia()
    {
        return $this->nombreEmergencia;
    }

    /**
     * Set telEmergencia
     *
     * @param string $telEmergencia
     *
     * @return Registro
     */
    public function setTelEmergencia($telEmergencia)
    {
        $this->telEmergencia = $telEmergencia;

        return $this;
    }

    /**
     * Get telEmergencia
     *
     * @return string
     */
    public function getTelEmergencia()
    {
        return $this->telEmergencia;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Registro
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Registro
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
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }

    // Archivos Upload

    /**
     * @return File|null
     */
    public function getCredencialFile()
    {
        return $this->credencialFile;
    }

    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return Registro
     */
    public function setCredencialFile(File $file = null)
    {
        $this->credencialFile = $file;
        if ($file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->createdAt = new \DateTime();
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCredencialName()
    {
        return $this->credencialName;
    }

    /**
     * @param string $credencialName
     * @return Registro
     */
    public function setCredencialName($credencialName)
    {
        $this->credencialName = $credencialName;

        return $this;
    }

    // Historial
    /**
     * @return File|null
     */
    public function getHistorialFile()
    {
        return $this->historialFile;
    }

    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return Registro
     */
    public function setHistorialFile(File $file = null)
    {
        $this->historialFile = $file;
        if ($file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->createdAt = new \DateTime();
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getHistorialName()
    {
        return $this->historialName;
    }

    /**
     * @param string $historialName
     * @return Registro
     */
    public function setHistorialName($historialName)
    {
        $this->historialName = $historialName;

        return $this;
    }

    // Formato
    /**
     * @return File|null
     */
    public function getFormatoFile()
    {
        return $this->formatoFile;
    }

    /**
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return Registro
     */
    public function setFormatoFile(File $file = null)
    {
        $this->formatoFile = $file;
        if ($file) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->createdAt = new \DateTime();
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFormatoName()
    {
        return $this->formatoName;
    }

    /**
     * @param string $formatoName
     * @return Registro
     */
    public function setFormatoName($formatoName)
    {
        $this->formatoName = $formatoName;

        return $this;
    }
}

