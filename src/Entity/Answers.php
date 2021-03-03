<?php

namespace App\Entity;

use App\Repository\AnswersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnswersRepository::class)
 */
class Answers
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
    private $answer_title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $answer_description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $answer_author;

    /**
     * @ORM\Column(type="datetime")
     */
    private $answer_date;


    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $answer_code_1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $answer_code_2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $answer_code_3;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $answer_code_4;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $answer_code_5;

    /**
     * @ORM\ManyToOne(targetEntity=Questions::class, inversedBy="answers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $question_id;

    /**
     * @ORM\OneToMany(targetEntity=AnswerLike::class, mappedBy="answer")
     */
    private $answerLikes;

    public function __construct()
    {
        $this->answerLikes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswerTitle(): ?string
    {
        return $this->answer_title;
    }

    public function setAnswerTitle(string $answer_title): self
    {
        $this->answer_title = $answer_title;

        return $this;
    }

    public function getAnswerDescription(): ?string
    {
        return $this->answer_description;
    }

    public function setAnswerDescription(string $answer_description): self
    {
        $this->answer_description = $answer_description;

        return $this;
    }

    public function getAnswerAuthor(): ?string
    {
        return $this->answer_author;
    }

    public function setAnswerAuthor(string $answer_author): self
    {
        $this->answer_author = $answer_author;

        return $this;
    }

    public function getAnswerDate(): ?\DateTimeInterface
    {
        return $this->answer_date;
    }

    public function setAnswerDate(\DateTimeInterface $answer_date): self
    {
        $this->answer_date = $answer_date;

        return $this;
    }


    public function getAnswerCode1(): ?string
    {
        return $this->answer_code_1;
    }

    public function setAnswerCode1(?string $answer_code_1): self
    {
        $this->answer_code_1 = $answer_code_1;

        return $this;
    }

    public function getAnswerCode2(): ?string
    {
        return $this->answer_code_2;
    }

    public function setAnswerCode2(?string $answer_code_2): self
    {
        $this->answer_code_2 = $answer_code_2;

        return $this;
    }

    public function getAnswerCode3(): ?string
    {
        return $this->answer_code_3;
    }

    public function setAnswerCode3(?string $answer_code_3): self
    {
        $this->answer_code_3 = $answer_code_3;

        return $this;
    }

    public function getAnswerCode4(): ?string
    {
        return $this->answer_code_4;
    }

    public function setAnswerCode4(?string $answer_code_4): self
    {
        $this->answer_code_4 = $answer_code_4;

        return $this;
    }

    public function getAnswerCode5(): ?string
    {
        return $this->answer_code_5;
    }

    public function setAnswerCode5(?string $answer_code_5): self
    {
        $this->answer_code_5 = $answer_code_5;

        return $this;
    }

    public function getQuestionId(): ?Questions
    {
        return $this->question_id;
    }

    public function setQuestionId(?Questions $question_id): self
    {
        $this->question_id = $question_id;

        return $this;
    }

    /**
     * @return Collection|AnswerLike[]
     */
    public function getAnswerLikes(): Collection
    {
        return $this->answerLikes;
    }

    public function addAnswerLike(AnswerLike $answerLike): self
    {
        if (!$this->answerLikes->contains($answerLike)) {
            $this->answerLikes[] = $answerLike;
            $answerLike->setAnswer($this);
        }

        return $this;
    }

    public function removeAnswerLike(AnswerLike $answerLike): self
    {
        if ($this->answerLikes->removeElement($answerLike)) {
            // set the owning side to null (unless already changed)
            if ($answerLike->getAnswer() === $this) {
                $answerLike->setAnswer(null);
            }
        }

        return $this;
    }

    public function isLikedByUser(User $user):bool {
        foreach ($this->answerLikes as $answerLike){
            if($answerLike->getUser() === $user) return true;
        }
        return false;
    }
}
