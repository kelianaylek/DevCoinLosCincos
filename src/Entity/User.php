<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
        /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank()
     */
    private $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * The below length depends on the "algorithm" you use for encoding
     * the password, but this works well with bcrypt.
     *
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @ORM\Column(type="array")
     */
    private $roles;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $study_year;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $discord_tag;

    /**
     * @ORM\Column(type="string")
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=AnswerLike::class, mappedBy="user")
     */
    private $answerLikes;

    public function __construct()
    {
        $this->roles = array('ROLE_USER');
        $this->answerLikes = new ArrayCollection();
    }

    // other properties and methods

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getStudyYear(): ?int
    {
        return $this->study_year;
    }

    public function setStudyYear(?int $study_year): self
    {
        $this->study_year = $study_year;

        return $this;
    }

    public function getDiscordTag(): ?string
    {
        return $this->discord_tag;
    }

    public function setDiscordTag(?string $discord_tag): self
    {
        $this->discord_tag = $discord_tag;

        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

//    public function serialize(): array
//    {
//        return [
//            'id' => $this->id,
//            'image' => $this->image,
//            //......
//        ];
//    }

//    public function __unserialize(array $serialized): User
//    {
//        $this->id = $serialized['id'];
//        $this->image = $serialized['image'];
//        // .....
//        return $this;
//    }

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
        $answerLike->setUser($this);
    }

    return $this;
}

public function removeAnswerLike(AnswerLike $answerLike): self
{
    if ($this->answerLikes->removeElement($answerLike)) {
        // set the owning side to null (unless already changed)
        if ($answerLike->getUser() === $this) {
            $answerLike->setUser(null);
        }
    }

    return $this;
}
}
