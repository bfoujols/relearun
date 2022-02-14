<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\StateRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: StateRepository::class)]
#[ApiResource ()]
class State
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'datetime')]
    private $createdDate;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\ManyToOne(targetEntity: Env::class)]
    private $env;

    #[ORM\ManyToOne(targetEntity: Version::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $version;


    public function __construct()
    {
        $this->createdDate = new \DateTime();
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
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

    public function getEnv(): ?Env
    {
        return $this->env;
    }

    public function setEnv(?Env $env): self
    {
        $this->env = $env;

        return $this;
    }

    public function getVersion(): ?Version
    {
        return $this->version;
    }

    public function setVersion(?Version $version): self
    {
        $this->version = $version;

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getCreatedDate();
    }
}
