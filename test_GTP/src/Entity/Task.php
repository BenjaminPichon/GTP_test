<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskRepository::class)
 */
class Task
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
    private $Libelle;

    /**
     * @ORM\Column(type="time")
     */
    private $Starttime;

    /**
     * @ORM\Column(type="time")
     */
    private $Endtime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee", inversedBy="tasks")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Employee;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->Libelle;
    }

    public function setLibelle(string $Libelle): self
    {
        $this->Libelle = $Libelle;

        return $this;
    }

    public function getStarttime(): ?\DateTimeInterface
    {
        return $this->Starttime;
    }

    public function setStarttime(\DateTimeInterface $Starttime): self
    {
        $this->Starttime = $Starttime;

        return $this;
    }

    public function getEndtime(): ?\DateTimeInterface
    {
        return $this->Endtime;
    }

    public function setEndtime(\DateTimeInterface $Endtime): self
    {
        $this->Endtime = $Endtime;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->Employee;
    }

    public function setEmployee(?Employee $Employee): self
    {
        $this->Employee = $Employee;

        return $this;
    }
}
