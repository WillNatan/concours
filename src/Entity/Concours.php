<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConcoursRepository")
 */
class Concours
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FormContest", mappedBy="nomConcours")
     */
    private $formContests;

    /**
     * @ORM\Column(type="boolean")
     */
    private $consentment;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    public function __construct()
    {
        $this->formContests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return Collection|FormContest[]
     */
    public function getFormContests(): Collection
    {
        return $this->formContests;
    }

    public function addFormContest(FormContest $formContest): self
    {
        if (!$this->formContests->contains($formContest)) {
            $this->formContests[] = $formContest;
            $formContest->setNomConcours($this);
        }

        return $this;
    }

    public function removeFormContest(FormContest $formContest): self
    {
        if ($this->formContests->contains($formContest)) {
            $this->formContests->removeElement($formContest);
            // set the owning side to null (unless already changed)
            if ($formContest->getNomConcours() === $this) {
                $formContest->setNomConcours(null);
            }
        }

        return $this;
    }

    public function getConsentment(): ?bool
    {
        return $this->consentment;
    }

    public function setConsentment(bool $consentment): self
    {
        $this->consentment = $consentment;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
