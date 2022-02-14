<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CodeRepository::class)]
#[ApiResource (
//     collectionOperations: [
//         'get' => ['method' => 'get'],
//     ],
//     itemOperations: [
//     'get'=> ['method' => 'get'],
// // ],
//             normalizationContext:['groups' => ['read:collection', 'read:item', 'read:Post']],
//             denormalizationContext:['groups' => ['put:Post']],
//             itemOperations:['put', 
//                             'delete', 
//                             'get'
//                             // => ['normalization_context'=> ['groups'=> ['read:collection', 'read:item', 'read:Post'] ]] 
//                             ]

)
]
class Code
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    //#[Groups('read:item','read:Post', 'read:collection')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    
   // #[Groups('put:Post','read:Post', 'read:item', 'read:collection')]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $inheritance;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
   // #[Groups('read:item', 'read:collection')]
    private $type;

    #[ORM\OneToMany(mappedBy: 'code', targetEntity: Version::class, orphanRemoval:true)]
    #[ORM\JoinColumn(onDelete:"CASCADE")]
    private $versions;

    #[ORM\OneToMany(mappedBy: 'code', targetEntity: Env::class, orphanRemoval:true)]
    #[ORM\JoinColumn(onDelete:"CASCADE")]
    private $envs;

    


    public function __construct()
    {
        $this->versions = new ArrayCollection();
        $this->envs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getInheritance(): ?int
    {
        return $this->inheritance;
    }

    public function setInheritance(int $inheritance): self
    {
        $this->inheritance = $inheritance;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Version[]
     */
    public function getVersions(): Collection
    {
        return $this->versions;
    }

    public function addVersion(Version $version): self
    {
        if (!$this->versions->contains($version)) {
            $this->versions[] = $version;
            $version->setCode($this);
        }

        return $this;
    }

    public function removeVersion(Version $version): self
    {
        if ($this->versions->removeElement($version)) {
            // set the owning side to null (unless already changed)
            if ($version->getCode() === $this) {
                $version->setCode(null);
            }
        }

        return $this;
    }
     /**
     * @return Collection|Env[]
     */
    public function getEnvs(): Collection
    {
        return $this->envs;
    }

    public function addEnv(Env $env): self
    {
        if (!$this->envs->contains($env)) {
            $this->envs[] = $env;
            $env->setCode($this);
        }

        return $this;
    }

    public function removeEnv(Env $env): self
    {
        if ($this->envs->removeElement($env)) {
            // set the owning side to null (unless already changed)
            if ($env->getCode() === $this) {
                $env->setCode(null);
            }
        }

        return $this;
    }
    public function __toString()
{
    return (string) $this->getId();
}
}
