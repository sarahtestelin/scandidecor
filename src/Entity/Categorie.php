<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Meuble>
     */
    #[ORM\ManyToMany(targetEntity: Meuble::class, mappedBy: 'categorie')]
    private Collection $meubles;

    public function __construct()
    {
        $this->meubles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, Meuble>
     */
    public function getMeubles(): Collection
    {
        return $this->meubles;
    }

    public function addMeuble(Meuble $meuble): static
    {
        if (!$this->meubles->contains($meuble)) {
            $this->meubles->add($meuble);
            $meuble->addCategorie($this);
        }

        return $this;
    }

    public function removeMeuble(Meuble $meuble): static
    {
        if ($this->meubles->removeElement($meuble)) {
            $meuble->removeCategorie($this);
        }

        return $this;
    }
}
