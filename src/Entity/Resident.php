<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ResidentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;


/**
 * @ApiResource()
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass=ResidentRepository::class)
 */
class Resident
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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="date")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $endingDate;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="residents_avatars", fileNameProperty="avatar")
     * 
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roomNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $liveStreaming;


    /**
     * @ORM\OneToMany(targetEntity=BloodPressure::class, mappedBy="resident")
     */
    private $bloodPressures;

    /**
     * @ORM\OneToMany(targetEntity=Temperature::class, mappedBy="resident")
     */
    private $temperatures;

    /**
     * @ORM\OneToMany(targetEntity=Glycemia::class, mappedBy="resident")
     */
    private $glycemias;

    /**
     * @ORM\OneToMany(targetEntity=Weight::class, mappedBy="resident")
     */
    private $weights;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity=Family::class, inversedBy="residents")
     */
    private $family;

 



    public function __construct()
    {
        $this->bloodPressures = new ArrayCollection();
        $this->temperatures = new ArrayCollection();
        $this->glycemias = new ArrayCollection();
        $this->weights = new ArrayCollection();
        $this->startDate = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

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

    public function getEndingDate(): ?\DateTimeInterface
    {
        return $this->endingDate;
    }

    public function setEndingDate(?\DateTimeInterface $endingDate): self
    {
        $this->endingDate = $endingDate;

        return $this;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        // if (null !== $imageFile) {
        //     // It is required that at least one field changes if you are using doctrine
        //     // otherwise the event listeners won't be called and the file is lost
        //     $this->updatedAt = new \DateTimeImmutable();
        // }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getRoomNumber(): ?string
    {
        return $this->roomNumber;
    }

    public function setRoomNumber(string $roomNumber): self
    {
        $this->roomNumber = $roomNumber;

        return $this;
    }



    public function getLiveStreaming(): ?string
    {
        return $this->liveStreaming;
    }

    public function setLiveStreaming(?string $liveStreaming): self
    {
        $this->liveStreaming = $liveStreaming;

        return $this;
    }

    /**
     * @return Collection|BloodPressure[]
     */
    public function getBloodPressures(): Collection
    {
        return $this->bloodPressures;
    }

    public function addBloodPressure(BloodPressure $bloodPressure): self
    {
        if (!$this->bloodPressures->contains($bloodPressure)) {
            $this->bloodPressures[] = $bloodPressure;
            $bloodPressure->setResident($this);
        }

        return $this;
    }

    public function removeBloodPressure(BloodPressure $bloodPressure): self
    {
        if ($this->bloodPressures->contains($bloodPressure)) {
            $this->bloodPressures->removeElement($bloodPressure);
            // set the owning side to null (unless already changed)
            if ($bloodPressure->getResident() === $this) {
                $bloodPressure->setResident(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Temperature[]
     */
    public function getTemperatures(): Collection
    {
        return $this->temperatures;
    }

    public function addTemperature(Temperature $temperature): self
    {
        if (!$this->temperatures->contains($temperature)) {
            $this->temperatures[] = $temperature;
            $temperature->setResident($this);
        }

        return $this;
    }

    public function removeTemperature(Temperature $temperature): self
    {
        if ($this->temperatures->contains($temperature)) {
            $this->temperatures->removeElement($temperature);
            // set the owning side to null (unless already changed)
            if ($temperature->getResident() === $this) {
                $temperature->setResident(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Glycemia[]
     */
    public function getGlycemias(): Collection
    {
        return $this->glycemias;
    }

    public function addGlycemia(Glycemia $glycemia): self
    {
        if (!$this->glycemias->contains($glycemia)) {
            $this->glycemias[] = $glycemia;
            $glycemia->setResident($this);
        }

        return $this;
    }

    public function removeGlycemia(Glycemia $glycemia): self
    {
        if ($this->glycemias->contains($glycemia)) {
            $this->glycemias->removeElement($glycemia);
            // set the owning side to null (unless already changed)
            if ($glycemia->getResident() === $this) {
                $glycemia->setResident(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Weight[]
     */
    public function getWeights(): Collection
    {
        return $this->weights;
    }

    public function addWeight(Weight $weight): self
    {
        if (!$this->weights->contains($weight)) {
            $this->weights[] = $weight;
            $weight->setResident($this);
        }

        return $this;
    }

    public function removeWeight(Weight $weight): self
    {
        if ($this->weights->contains($weight)) {
            $this->weights->removeElement($weight);
            // set the owning side to null (unless already changed)
            if ($weight->getResident() === $this) {
                $weight->setResident(null);
            }
        }

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getFamily(): ?Family
    {
        return $this->family;
    }

    public function setFamily(?Family $family): self
    {
        $this->family = $family;

        return $this;
    }


}
