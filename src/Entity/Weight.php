<?php

namespace App\Entity;

use App\Repository\WeightRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WeightRepository::class)
 */
class Weight
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Resident::class, inversedBy="weights")
     */
    private $resident;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $caregiver;

    /**
     * @ORM\Column(type="datetime")
     */
    private $measuredAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResident(): ?Resident
    {
        return $this->resident;
    }

    public function setResident(?Resident $resident): self
    {
        $this->resident = $resident;

        return $this;
    }

    public function getCaregiver(): ?User
    {
        return $this->caregiver;
    }

    public function setCaregiver(?User $caregiver): self
    {
        $this->caregiver = $caregiver;

        return $this;
    }

    public function getMeasuredAt(): ?\DateTimeInterface
    {
        return $this->measuredAt;
    }

    public function setMeasuredAt(\DateTimeInterface $measuredAt): self
    {
        $this->measuredAt = $measuredAt;

        return $this;
    }
}
