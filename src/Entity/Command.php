<?php

namespace App\Entity;

use App\Repository\CommandRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandRepository::class)
 */
class Command
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nameClient;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCommand;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateWish;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $cellphoneNumber;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $situation;

    /**
     * @ORM\OneToMany(targetEntity=DetailCommand::class, mappedBy="command")
     */
    private $detailCommands;

    public function __construct()
    {
        $this->detailCommands = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameClient(): ?string
    {
        return $this->nameClient;
    }

    public function setNameClient(string $nameClient): self
    {
        $this->nameClient = $nameClient;

        return $this;
    }

    public function getDateCommand(): ?\DateTimeInterface
    {
        return $this->dateCommand;
    }

    public function setDateCommand(\DateTimeInterface $dateCommand): self
    {
        $this->dateCommand = $dateCommand;

        return $this;
    }

    public function getDateWish(): ?\DateTimeInterface
    {
        return $this->dateWish;
    }

    public function setDateWish(\DateTimeInterface $dateWish): self
    {
        $this->dateWish = $dateWish;

        return $this;
    }

    public function getCellphoneNumber(): ?string
    {
        return $this->cellphoneNumber;
    }

    public function setCellphoneNumber(string $cellphoneNumber): self
    {
        $this->cellphoneNumber = $cellphoneNumber;

        return $this;
    }

    public function getSituation(): ?string
    {
        return $this->situation;
    }

    public function setSituation(string $situation): self
    {
        $this->situation = $situation;

        return $this;
    }

    /**
     * @return Collection|DetailCommand[]
     */
    public function getDetailCommands(): Collection
    {
        return $this->detailCommands;
    }

    public function addDetailCommand(DetailCommand $detailCommand): self
    {
        if (!$this->detailCommands->contains($detailCommand)) {
            $this->detailCommands[] = $detailCommand;
            $detailCommand->setCommand($this);
        }

        return $this;
    }

    public function removeDetailCommand(DetailCommand $detailCommand): self
    {
        if ($this->detailCommands->contains($detailCommand)) {
            $this->detailCommands->removeElement($detailCommand);
            // set the owning side to null (unless already changed)
            if ($detailCommand->getCommand() === $this) {
                $detailCommand->setCommand(null);
            }
        }

        return $this;
    }
}
