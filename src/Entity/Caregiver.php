<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CaregiverRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CaregiverRepository::class)
 */
class Caregiver
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $natIdCard;

    /**
     * @ORM\Column(type="date")
     */
    private $startDate;

    /**
     * @ORM\Column(type="date")
     */
    private $leftDate;

    /**
     * @ORM\Column(type="date")
     */
    private $certificatedAt;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;


    public function __construct()
    {
        $this->startDate = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNatIdCard(): ?string
    {
        return $this->natIdCard;
    }

    public function setNatIdCard(string $natIdCard): self
    {
        $this->natIdCard = $natIdCard;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getLeftDate(): ?\DateTimeInterface
    {
        return $this->leftDate;
    }

    public function setLeftDate(\DateTimeInterface $leftDate): self
    {
        $this->leftDate = $leftDate;

        return $this;
    }

    public function getCertificatedAt(): ?\DateTimeInterface
    {
        return $this->certificatedAt;
    }

    public function setCertificatedAt(\DateTimeInterface $certificatedAt): self
    {
        $this->certificatedAt = $certificatedAt;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
