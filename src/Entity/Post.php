<?php

namespace App\Entity;

use App\Entity\Trait\CreatedDateTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\IdTrait;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 * @ORM\Table(name ="post")
 * @ORM\HasLifecycleCallbacks
 */
class Post
{
    use IdTrait;
    use CreatedDateTrait;

    /**
     * 
     * @ORM\Column(name="content", type="string", length=1000)
     */
    private $content='';


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="positiveOpinion")
     * @ORM\JoinTable(name="OpinionPositive")
     */
    private $usersPositive;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="negativeOpinion")
     * @ORM\JoinTable(name="OpinionNegative")
     */
    private $usersNegative;

    public function __construct()
    {
        $this->opinionPositives = new ArrayCollection();
        $this->usersPositive = new ArrayCollection();
        $this->usersNegative = new ArrayCollection();
    }

    public function setContent(string $content):void
    {
        $this->content=$content;
    }

    public function getContent():string
    {
        return $this->content;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getCategories(): ?Category
    {
        return $this->categories;
    }

    public function setCategories(?Category $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsersPositive(): Collection
    {
        return $this->usersPositive;
    }

    public function addUsersPositive(User $usersPositive): self
    {
        if (!$this->usersPositive->contains($usersPositive)) {
            $this->usersPositive[] = $usersPositive;
        }

        return $this;
    }

    public function removeUsersPositive(User $usersPositive): self
    {
        $this->usersPositive->removeElement($usersPositive);

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsersNegative(): Collection
    {
        return $this->usersNegative;
    }

    public function addUsersNegative(User $usersNegative): self
    {
        if (!$this->usersNegative->contains($usersNegative)) {
            $this->usersNegative[] = $usersNegative;
        }

        return $this;
    }

    public function removeUsersNegative(User $usersNegative): self
    {
        $this->usersNegative->removeElement($usersNegative);

        return $this;
    }

}
