<?php

namespace App\Entity;

use App\Repository\AuditRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuditRepository::class)]
class Audit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'audits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    /**
     * @var Collection<int, DocumentAudit>
     */
    #[ORM\OneToMany(targetEntity: DocumentAudit::class, mappedBy: 'audit', orphanRemoval: true)]
    private Collection $documentAudits;

    public function __construct()
    {
        $this->documentAudits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, DocumentAudit>
     */
    public function getDocumentAudits(): Collection
    {
        return $this->documentAudits;
    }

    public function addDocumentAudit(DocumentAudit $documentAudit): static
    {
        if (!$this->documentAudits->contains($documentAudit)) {
            $this->documentAudits->add($documentAudit);
            $documentAudit->setAudit($this);
        }

        return $this;
    }

    public function removeDocumentAudit(DocumentAudit $documentAudit): static
    {
        if ($this->documentAudits->removeElement($documentAudit)) {
            // set the owning side to null (unless already changed)
            if ($documentAudit->getAudit() === $this) {
                $documentAudit->setAudit(null);
            }
        }

        return $this;
    }
}
