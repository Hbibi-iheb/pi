<?php

namespace App\Entity;

use App\Repository\PostLikeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PostLikeRepository::class)]
class PostLike
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $type = null;

    #[ORM\Column]
    private ?int $user_id = null;

    #[ORM\ManyToOne(inversedBy: 'postLikes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PostForum $post = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isType(): ?bool
    {
        return $this->type;
    }

    public function setType(bool $type): self
    {
        $this->type = $type;

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

    public function getPost(): ?PostForum
    {
        return $this->post;
    }

    public function setPost(?PostForum $post): self
    {
        $this->post = $post;

        return $this;
    }
}
