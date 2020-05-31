<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="tasks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $userId;

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

    public function getUserId(): ?User
    {
        return $this->userId;
    }

    public function setUserId(?User $userId): self
    {
        $this->userId = $userId;

        return $this;
    }
}
