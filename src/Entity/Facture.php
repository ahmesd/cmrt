<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reference;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Montantht;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Tva;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Timber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity=Fournisseurs::class, inversedBy="factures")
     */
    private $Fournisseurs;

    /**
     * @ORM\OneToMany(targetEntity=Payement::class, mappedBy="Reference_Facture")
     */
    private $payements;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $RS;

    public function __construct()
    {
        $this->payements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getMontantht(): ?float
    {
        return $this->Montantht;
    }

    public function setMontantht(?float $Montantht): self
    {
        $this->Montantht = $Montantht;

        return $this;
    }

    public function getTva(): ?int
    {
        return $this->Tva;
    }

    public function setTva(?int $Tva): self
    {
        $this->Tva = $Tva;

        return $this;
    }

    public function getTimber(): ?float
    {
        return $this->Timber;
    }

    public function setTimber(?float $Timber): self
    {
        $this->Timber = $Timber;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getFournisseurs(): ?Fournisseurs
    {
        return $this->Fournisseurs;
    }

    public function setFournisseurs(?Fournisseurs $Fournisseurs): self
    {
        $this->Fournisseurs = $Fournisseurs;

        return $this;
    }

    /**
     * @return Collection|Payement[]
     */
    public function getPayements(): Collection
    {
        return $this->payements;
    }

    public function addPayement(Payement $payement): self
    {
        if (!$this->payements->contains($payement)) {
            $this->payements[] = $payement;
            $payement->setReferenceFacture($this);
        }

        return $this;
    }

    public function removePayement(Payement $payement): self
    {
        if ($this->payements->removeElement($payement)) {
            // set the owning side to null (unless already changed)
            if ($payement->getReferenceFacture() === $this) {
                $payement->setReferenceFacture(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string)$this->getReference() ;
    }

    public function getRS(): ?float
    {
        return $this->RS;
    }

    public function setRS(?float $RS): self
    {
        $this->RS = $RS;

        return $this;
    }
   
    
   
    
}
