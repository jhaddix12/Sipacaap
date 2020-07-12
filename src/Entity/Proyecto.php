<?php

namespace App\Entity;

use App\Repository\ProyectoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProyectoRepository::class)
 */
class Proyecto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombreProyecto;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombreGuia;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ubicacion;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $foto;

    /**
     * @ORM\Column(type="string", length=700)
     */
    private $descripcion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombreProyecto(): ?string
    {
        return $this->nombreProyecto;
    }

    public function setNombreProyecto(string $nombreProyecto): self
    {
        $this->nombreProyecto = $nombreProyecto;

        return $this;
    }

    public function getNombreGuia(): ?string
    {
        return $this->nombreGuia;
    }

    public function setNombreGuia(?string $nombreGuia): self
    {
        $this->nombreGuia = $nombreGuia;

        return $this;
    }

    public function getUbicacion(): ?string
    {
        return $this->ubicacion;
    }

    public function setUbicacion(string $ubicacion): self
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): self
    {
        $this->foto = $foto;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }
}
