<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuestionsRepository::class)
 */
class Questions
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $question_title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $question_description;
    /**
     * @ORM\Column(type="boolean")
     */
    private $question_is_resolved;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $question_answers;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $question_author;

    /**
     * @ORM\Column(type="datetime")
     */
    private $question_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionTitle(): ?string
    {
        return $this->question_title;
    }

    public function setQuestionTitle(string $question_title): self
    {
        $this->question_title = $question_title;

        return $this;
    }

    public function getQuestionDescription(): ?string
    {
        return $this->question_description;
    }

    public function setQuestionDescription(string $question_description): self
    {
        $this->question_description = $question_description;

        return $this;
    }

    public function getQuestionIsResolved(): ?bool
    {
        return $this->question_is_resolved;
    }

    public function setQuestionIsResolved(bool $question_is_resolved): self
    {
        $this->question_is_resolved = $question_is_resolved;

        return $this;
    }

    public function getQuestionAnswers(): ?int
    {
        return $this->question_answers;
    }

    public function setQuestionAnswers(?int $question_answers): self
    {
        $this->question_answers = $question_answers;

        return $this;
    }

    public function getQuestionAuthor(): ?string
    {
        return $this->question_author;
    }

    public function setQuestionAuthor(string $question_author): self
    {
        $this->question_author = $question_author;

        return $this;
    }

    public function getQuestionDate(): ?\DateTimeInterface
    {
        return $this->question_date;
    }

    public function setQuestionDate(\DateTimeInterface $question_date): self
    {
        $this->question_date = $question_date;

        return $this;
    }
}
