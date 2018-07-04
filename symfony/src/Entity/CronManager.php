<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CronManagerRepository")
 */
class CronManager
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $last_executed_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_lock;

    public function getId()
    {
        return $this->id;
    }

    public function getLastExecutedAt(): ?\DateTimeInterface
    {
        return $this->last_executed_at;
    }

    public function setLastExecutedAt(\DateTimeInterface $last_executed_at): self
    {
        $this->last_executed_at = $last_executed_at;

        return $this;
    }

    public function getIsLock(): ?bool
    {
        return $this->is_lock;
    }

    public function setIsLock(bool $is_lock): self
    {
        $this->is_lock = $is_lock;

        return $this;
    }
}
