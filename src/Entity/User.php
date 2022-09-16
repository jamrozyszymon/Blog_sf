<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=App\Repository\UserRepository::class)
 * @UniqueEntity(fields= {"name"})
 * @UniqueEntity(fields= {"email"})
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false, hardDelete=true)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity=Post::class, mappedBy="users")
     */
    private $posts;

    /**
     * @ORM\ManyToMany(targetEntity=Post::class, mappedBy="usersPositive")
     * @ORM\JoinTable(name="OpinionPositive")
     */
    private $positiveOpinion;

    /**
     * @ORM\ManyToMany(targetEntity=Post::class, mappedBy="usersNegative")
     * @ORM\JoinTable(name="OpinionNegative")
     */
    private $negativeOpinion;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;


    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->postLikes = new ArrayCollection();
        $this->opinionPositives = new ArrayCollection();
        $this->positiveOpinion = new ArrayCollection();
        $this->negativeOpinion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts[] = $post;
            $post->setUsers($this);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        if ($this->posts->removeElement($post)) {
            // set the owning side to null (unless already changed)
            if ($post->getUsers() === $this) {
                $post->setUsers(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getPositiveOpinion(): Collection
    {
        return $this->positiveOpinion;
    }

    public function addPositiveOpinion(Post $positiveOpinion): self
    {
        if (!$this->positiveOpinion->contains($positiveOpinion)) {
            $this->positiveOpinion[] = $positiveOpinion;
            $positiveOpinion->addUsersPositive($this);
        }

        return $this;
    }

    public function removePositiveOpinion(Post $positiveOpinion): self
    {
        if ($this->positiveOpinion->removeElement($positiveOpinion)) {
            $positiveOpinion->removeUsersPositive($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Post>
     */
    public function getNegativeOpinion(): Collection
    {
        return $this->negativeOpinion;
    }

    public function addNegativeOpinion(Post $negativeOpinion): self
    {
        if (!$this->negativeOpinion->contains($negativeOpinion)) {
            $this->negativeOpinion[] = $negativeOpinion;
            $negativeOpinion->addUsersNegative($this);
        }

        return $this;
    }

    public function removeNegativeOpinion(Post $negativeOpinion): self
    {
        if ($this->negativeOpinion->removeElement($negativeOpinion)) {
            $negativeOpinion->removeUsersNegative($this);
        }

        return $this;
    }

    public function getDeletedAt(): ?\DateTime
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(?\DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

}
