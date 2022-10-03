<?php

namespace App\Entity\Trait;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Return date of creation
 */
trait CreatedDateTrait
{
    /**
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * With possibilities to override date in DoctrineFixtureBundle
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        if(isset($this->createdFixture)){
            $this->created = $this->createdFixture;
        } else {
        $this->created = new DateTime("now");
        return $this;
        }
    }

    public function onPrePersistFixture($created)
    {
        $this->createdFixture = $created;
        return $this;
    }

    /**
     * @return DateTime $created
     */
    public function getCreatedDate(): DateTime
    {
        return $this->created;
    }
}
