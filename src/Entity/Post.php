<?php

namespace App\Entity;

use App\Entity\Trait\CreatedDateTrait;
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
     * @ORM\OneToMany(targetEntity="App\Entity\PostLike", mappedBy="post")
     */
    private $postLike;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="posts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;


    public function getPostLike()
    {
        return $this->getPostlike;
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
}
