<?php

namespace App\Entity;

use App\Repository\MeubleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MeubleRepository::class)]
class Meuble
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $libelle = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $prix = null;

    /**
     * @var Collection<int, Associer>
     */
    #[ORM\OneToMany(targetEntity: Associer::class, mappedBy: 'meuble')]
    private Collection $associers;

    /**
     * @var Collection<int, Categorie>
     */
    #[ORM\ManyToMany(targetEntity: Categorie::class, inversedBy: 'meubles')]
    private Collection $categorie;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $image = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'Favoris')]
    private Collection $users;

    /**
     * @var Collection<int, Ajouter>
     */
    #[ORM\OneToMany(targetEntity: Ajouter::class, mappedBy: 'meuble')]
    private Collection $ajouters;

    public function __construct()
    {
        $this->associers = new ArrayCollection();
        $this->categorie = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->ajouters = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * @return Collection<int, Associer>
     */
    public function getAssociers(): Collection
    {
        return $this->associers;
    }

    public function addAssocier(Associer $associer): static
    {
        if (!$this->associers->contains($associer)) {
            $this->associers->add($associer);
            $associer->setMeuble($this);
        }

        return $this;
    }

    public function removeAssocier(Associer $associer): static
    {
        if ($this->associers->removeElement($associer)) {
            // set the owning side to null (unless already changed)
            if ($associer->getMeuble() === $this) {
                $associer->setMeuble(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Categorie>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categorie $categorie): static
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): static
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addFavori($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeFavori($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Ajouter>
     */
    public function getAjouters(): Collection
    {
        return $this->ajouters;
    }

    public function addAjouter(Ajouter $ajouter): static
    {
        if (!$this->ajouters->contains($ajouter)) {
            $this->ajouters->add($ajouter);
            $ajouter->setMeuble($this);
        }

        return $this;
    }

    public function removeAjouter(Ajouter $ajouter): static
    {
        if ($this->ajouters->removeElement($ajouter)) {
            // set the owning side to null (unless already changed)
            if ($ajouter->getMeuble() === $this) {
                $ajouter->setMeuble(null);
            }
        }

        return $this;
    }
}
