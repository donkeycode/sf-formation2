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
     * @ORM\OneToOne(targetEntity=Bien::class)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $bien;

    public function getBien(): Bien
    {
        return $this->bien;
    }

    public function setBien(Bien $bien): self
    {
        $this->bien = $bien;

        return $this;
    }
}
