<?php

namespace App\Entity;

use App\Repository\FollowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FollowRepository::class)]
class Follow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, user>
     */
    #[ORM\OneToMany(targetEntity: user::class, mappedBy: 'no')]
    private Collection $follower;

    public function __construct()
    {
        $this->follower = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, user>
     */
    public function getFollower(): Collection
    {
        return $this->follower;
    }

    public function addFollower(user $follower): static
    {
        if (!$this->follower->contains($follower)) {
            $this->follower->add($follower);
            $follower->setNo($this);
        }

        return $this;
    }

    public function removeFollower(user $follower): static
    {
        if ($this->follower->removeElement($follower)) {
            // set the owning side to null (unless already changed)
            if ($follower->getNo() === $this) {
                $follower->setNo(null);
            }
        }

        return $this;
    }
}
