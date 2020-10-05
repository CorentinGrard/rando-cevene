<?php

namespace App\Entity;

use App\Repository\InscriptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InscriptionRepository::class)
 */
class Inscription
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $message;

    /**
     * @ORM\ManyToMany(targetEntity=Randonnee::class, inversedBy="inscriptions")
     */
    private $randonnees;

    public function __construct()
    {
        $this->randonnees = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return Collection|Randonnee[]
     */
    public function getRandonnees(): Collection
    {
        return $this->randonnees;
    }

    public function addRandonnee(Randonnee $randonnee): self
    {
        if (!$this->randonnees->contains($randonnee)) {
            $this->randonnees[] = $randonnee;
        }

        return $this;
    }

    public function removeRandonnee(Randonnee $randonnee): self
    {
        if ($this->randonnees->contains($randonnee)) {
            $this->randonnees->removeElement($randonnee);
        }

        return $this;
    }
}
