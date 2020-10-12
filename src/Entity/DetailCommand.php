<?php

namespace App\Entity;

use App\Repository\DetailCommandRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailCommandRepository::class)
 */
class DetailCommand
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\OneToOne(targetEntity=Product::class, mappedBy="detailCommand", cascade={"persist", "remove"})
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity=Command::class, inversedBy="detailCommands")
     * @ORM\JoinColumn(nullable=false)
     */
    private $command;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        // set (or unset) the owning side of the relation if necessary
        $newDetailCommand = null === $product ? null : $this;
        if ($product->getDetailCommand() !== $newDetailCommand) {
            $product->setDetailCommand($newDetailCommand);
        }

        return $this;
    }

    public function getCommand(): ?Command
    {
        return $this->command;
    }

    public function setCommand(?Command $command): self
    {
        $this->command = $command;

        return $this;
    }
}
