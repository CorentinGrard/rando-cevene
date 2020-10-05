<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
     * @ORM\OneToMany(targetEntity=Randonnee::class, mappedBy="categorie")
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
            $randonnee->setCategorie($this);
        }

        return $this;
    }

    public function removeRandonnee(Randonnee $randonnee): self
    {
        if ($this->randonnees->contains($randonnee)) {
            $this->randonnees->removeElement($randonnee);
            // set the owning side to null (unless already changed)
            if ($randonnee->getCategorie() === $this) {
                $randonnee->setCategorie(null);
            }
        }

        return $this;
    }
}
