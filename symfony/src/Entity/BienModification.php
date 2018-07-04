<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BienModificationRepository")
 */
class BienModification
{
    use BaseBien;

    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\OneToOne(targetEntity=Bien::class)
     */
    private $id;

    public function getId()
    {
        return $this->id;
    }

    public function setBien(Bien $bien)
    {
        $this->id = $bien->getId();

        return $this;
    }
}
