<?php

namespace App\Entity;

use App\Repository\CommentairePostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommentairePostRepository::class)]
class CommentairePost
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commentairePosts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PostForum $post = null;

    #[ORM\Column(length: 80)]
    #[Assert\NotBlank(message: "You have to write something!")]
    #[Assert\Length(
        min: 1,
        max: 150,
        minMessage: 'Comment must be atleast {{ limit }} characters long',
        maxMessage: 'Comment cant be longer than {{ limit }} characters',
    )]
    private ?string $contenu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column]
    private ?int $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?PostForum
    {
        return $this->post;
    }

    public function setPost(?PostForum $post): self
    {
        $this->post = $post;

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
}
