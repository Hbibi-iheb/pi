<?php

namespace App\Entity;

use App\Repository\CategoryForumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoryForumRepository::class)]
class CategoryForum
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("categories:read")]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 16,
        minMessage: 'Name must be atleast {{ limit }} characters long',
        maxMessage: 'Name cant be longer than {{ limit }} characters',
    )]
    #[Groups("categories:read")]
    private ?string $nom = null;

    #[ORM\Column(length: 80)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 15,
        max: 150,
        minMessage: 'Description must be atleast {{ limit }} characters long',
        maxMessage: 'Description cant be longer than {{ limit }} characters',
    )]
    #[Groups("categories:read")]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: PostForum::class, orphanRemoval: true)]
    private Collection $postForums;

    public function __construct()
    {
        $this->postForums = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, PostForum>
     */
    public function getPostForums(): Collection
    {
        return $this->postForums;
    }

    public function addPostForum(PostForum $postForum): self
    {
        if (!$this->postForums->contains($postForum)) {
            $this->postForums->add($postForum);
            $postForum->setCategorie($this);
        }

        return $this;
    }

    public function removePostForum(PostForum $postForum): self
    {
        if ($this->postForums->removeElement($postForum)) {
            // set the owning side to null (unless already changed)
            if ($postForum->getCategorie() === $this) {
                $postForum->setCategorie(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return (string)$this->nom;
    }
}
