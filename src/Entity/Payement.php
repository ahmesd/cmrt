<?php

namespace App\Entity;

use App\Repository\PayementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PayementRepository::class)
 */
class Payement
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
    private $Type_de_payement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Nature_de_payement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Nombre_de_tranche;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $Date_de_payement;

    /**
     * @ORM\ManyToOne(targetEntity=Facture::class, inversedBy="payements")
     */
    private $Reference_Facture;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Montantpayee;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Code;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeDePayement(): ?string
    {
        return $this->Type_de_payement;
    }

    public function setTypeDePayement(?string $Type_de_payement): self
    {
        $this->Type_de_payement = $Type_de_payement;

        return $this;
    }

    public function getNatureDePayement(): ?string
    {
        return $this->Nature_de_payement;
    }

    public function setNatureDePayement(?string $Nature_de_payement): self
    {
        $this->Nature_de_payement = $Nature_de_payement;

        return $this;
    }

    public function getNombreDeTranche(): ?int
    {
        return $this->Nombre_de_tranche;
    }

    public function setNombreDeTranche(?int $Nombre_de_tranche): self
    {
        $this->Nombre_de_tranche = $Nombre_de_tranche;

        return $this;
    }

    public function getDateDePayement(): ?\DateTimeInterface
    {
        return $this->Date_de_payement;
    }

    public function setDateDePayement(?\DateTimeInterface $Date_de_payement): self
    {
        $this->Date_de_payement = $Date_de_payement;

        return $this;
    }

    public function getReference_Facture(): ?Facture
    {
        return $this->Reference_Facture;
    }

    public function setReference_Facture(?Facture $Reference_Facture): self
    {
        $this->Reference_Facture = $Reference_Facture;

        return $this;
    }
    public function getReferenceFacture(): ?Facture
    {
        return $this->Reference_Facture;
    }

    public function setReferenceFacture(?Facture $Reference_Facture): self
    {
        $this->Reference_Facture = $Reference_Facture;

        return $this;
    }

    public function getMontantpayee(): ?float
    {
        return $this->Montantpayee;
    }

    public function setMontantpayee(?float $Montantpayee): self
    {
        $this->Montantpayee = $Montantpayee;

        return $this;
    }
    public function __toString()
    {
        return (string)$this->getReference_Facture();
    }

    public function getCode(): ?string
    {
        return $this->Code;
    }

    public function setCode(?string $Code): self
    {
        $this->Code = $Code;

        return $this;
    }
}
