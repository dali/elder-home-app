<?php

namespace App\Entity;

use App\Repository\BloodPressureRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BloodPressureRepository::class)
 * @ApiResource()
 */
class BloodPressure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $systolic;

    /**
     * @ORM\Column(type="smallint")
     */
    private $diastolic;

    /**
     * @ORM\Column(type="smallint")
     */
    private $pulse;

    /**
     * @ORM\ManyToOne(targetEntity=Resident::class, inversedBy="bloodPressures")
     */
    private $resident;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=false)
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

    public function getSystolic(): ?int
    {
        return $this->systolic;
    }

    public function setSystolic(int $systolic): self
    {
        $this->systolic = $systolic;

        return $this;
    }

    public function getDiastolic(): ?int
    {
        return $this->diastolic;
    }

    public function setDiastolic(int $diastolic): self
    {
        $this->diastolic = $diastolic;

        return $this;
    }

    public function getPulse(): ?int
    {
        return $this->pulse;
    }

    public function setPulse(int $pulse): self
    {
        $this->pulse = $pulse;

        return $this;
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
