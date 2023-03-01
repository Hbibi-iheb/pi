<?php

namespace App\Entity;

use App\Repository\PostForumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PostForumRepository::class)]
class PostForum
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'postForums')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategoryForum $categorie = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 15,
        max: 150,
        minMessage: 'Post Content must be atleast {{ limit }} characters long',
        maxMessage: 'Post Content cant be longer than {{ limit }} characters',
    )]
    private ?string $contenu = null;

    #[ORM\Column(length: 80)]
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 3,
        max: 30,
        minMessage: 'Post Title must be atleast {{ limit }} characters long',
        maxMessage: 'Post Title cant be longer than {{ limit }} characters',
    )]
    private ?string $titre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: CommentairePost::class, orphanRemoval: true)]
    private Collection $commentairePosts;

    #[ORM\OneToMany(mappedBy: 'post', targetEntity: PostLike::class, orphanRemoval: true)]
    private Collection $postLikes;

    public function __construct()
    {
        $this->commentairePosts = new ArrayCollection();
        $this->postLikes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?CategoryForum
    {
        return $this->categorie;
    }

    public function setCategorie(?CategoryForum $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection<int, CommentairePost>
     */
    public function getCommentairePosts(): Collection
    {
        return $this->commentairePosts;
    }

    public function addCommentairePost(CommentairePost $commentairePost): self
    {
        if (!$this->commentairePosts->contains($commentairePost)) {
            $this->commentairePosts->add($commentairePost);
            $commentairePost->setPost($this);
        }

        return $this;
    }

    public function removeCommentairePost(CommentairePost $commentairePost): self
    {
        if ($this->commentairePosts->removeElement($commentairePost)) {
            // set the owning side to null (unless already changed)
            if ($commentairePost->getPost() === $this) {
                $commentairePost->setPost(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PostLike>
     */
    public function getPostLikes(): Collection
    {
        return $this->postLikes;
    }

    public function addPostLike(PostLike $postLike): self
    {
        if (!$this->postLikes->contains($postLike)) {
            $this->postLikes->add($postLike);
            $postLike->setPost($this);
        }

        return $this;
    }

    public function removePostLike(PostLike $postLike): self
    {
        if ($this->postLikes->removeElement($postLike)) {
            // set the owning side to null (unless already changed)
            if ($postLike->getPost() === $this) {
                $postLike->setPost(null);
            }
        }

        return $this;
    }
    public function __toString(){
        return (string)$this->titre;
    }
}
