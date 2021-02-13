<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $question_code_1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $question_code_2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $question_code_3;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $question_code_4;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $question_code_5;

    /**
     * @ORM\OneToMany(targetEntity=Answers::class, mappedBy="question_id")
     */
    private $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

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


    public function getQuestionCode1(): ?string
    {
        return $this->question_code_1;
    }

    public function setQuestionCode1(?string $question_code_1): self
    {
        $this->question_code_1 = $question_code_1;

        return $this;
    }

    public function getQuestionCode2(): ?string
    {
        return $this->question_code_2;
    }

    public function setQuestionCode2(?string $question_code_2): self
    {
        $this->question_code_2 = $question_code_2;

        return $this;
    }

    public function getQuestionCode3(): ?string
    {
        return $this->question_code_3;
    }

    public function setQuestionCode3(?string $question_code_3): self
    {
        $this->question_code_3 = $question_code_3;

        return $this;
    }

    public function getQuestionCode4(): ?string
    {
        return $this->question_code_4;
    }

    public function setQuestionCode4(?string $question_code_4): self
    {
        $this->question_code_4 = $question_code_4;

        return $this;
    }

    public function getQuestionCode5(): ?string
    {
        return $this->question_code_5;
    }

    public function setQuestionCode5(?string $question_code_5): self
    {
        $this->question_code_5 = $question_code_5;

        return $this;
    }

    /**
     * @return Collection|Answers[]
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answers $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers[] = $answer;
            $answer->setQuestionId($this);
        }

        return $this;
    }

    public function removeAnswer(Answers $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestionId() === $this) {
                $answer->setQuestionId(null);
            }
        }

        return $this;
    }
}
