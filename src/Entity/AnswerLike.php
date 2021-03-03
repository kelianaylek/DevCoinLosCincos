<?php

namespace App\Entity;

use App\Repository\AnswerLikeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnswerLikeRepository::class)
 */
class AnswerLike
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Answers::class, inversedBy="answerLikes")
     */
    private $answer;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="answerLikes")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswer(): ?Answers
    {
        return $this->answer;
    }

    public function setAnswer(?Answers $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
