<?php

namespace App\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use App\AdminBundle\Entity\Turnovers;
use App\AdminBundle\Entity\ActivityArea;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Company
 *
 * @ORM\Table(name="company", indexes={@ORM\Index(name="company_legal_status2_FK", columns={"id_legal_status"}), @ORM\Index(name="company_company_category0_FK", columns={"id_company_category"}), @ORM\Index(name="id_salesperson", columns={"id_salesperson"}), @ORM\Index(name="company_activity_area_FK", columns={"id_activity_area"}), @ORM\Index(name="company_number_employees1_FK", columns={"id_number_employees"})})
 * @ORM\Entity(repositoryClass="App\AdminBundle\Repository\CompanyRepository")
 * @UniqueEntity("email", message="Cet email existe déjà dans la base de données, veuillez en saisir un autre.")
 * @Vich\Uploadable
 */
class Company
{
    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10, nullable=false)
     * @Assert\Length(
     *      max = 10,
     *      maxMessage = "Le code ne doit pas dépasser {{ limit }} caractères."
     * )
     * @ORM\Id
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @Assert\NotBlank(
     *      message = "Cette valeur ne doit pas être vide."
     * )
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Le nom doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le nom ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @ManyToOne(targetEntity="CompanyStatus")
     * @JoinColumn(name="id_companyStatus", referencedColumnName="id")
     */
    private $companyStatus;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="actif", type="boolean", nullable=true)
     */
    private $actif;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="company_logo", fileNameProperty="logo")
     * @Assert\Image(
     *     mimeTypes = {"image/png", "image/jpeg", "image/gif"}
     * )
     * @var File
     */
    private $imageFile;

    /**
     * @var string|null
     *
     * @ORM\Column(name="logo", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Le logo doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le logo ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $logo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=0, nullable=true)
     */
    private $comment;

    /**
     * @var \Salesperson
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_country", referencedColumnName="code")
     * })
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'adresse ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postal_code", type="string", length=100, nullable=true)
     * @Assert\Length(
     *      max = 100,
     *      maxMessage = "Le code postal ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $postalCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="town", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "La ville doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "La ville ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $town;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=10, nullable=true)
     * @Assert\Regex(
     *      pattern="/^[0-9]*$/",
     *      message="Seulement les nombres sont autorisés")
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      minMessage = "Veuillez saisir le numéro en 0612345678",
     *      maxMessage = "Veuillez saisir le numéro en 0612345678",
     *      exactMessage = "Le numéro de téléphone doit être à ce format 0XXXXXXXXX"
     * )
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fax", type="string", length=10, nullable=true)
     * @Assert\Regex(
     *      pattern="/^[0-9]*$/",
     *      message="Seulement les nombres sont autorisés")
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      minMessage = "Veuillez saisir le fax en 0612345678",
     *      maxMessage = "Veuillez saisir le fax en 0612345678",
     *      exactMessage = "Le numéro de fax doit être à ce format 0XXXXXXXXX"
     * )
     */
    private $fax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     * @Assert\Url
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Le site web doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le site web ne doit pas dépasser {{ limit }} caractères."
     * )
     */
    private $website;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at_company", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $createdAtCompany;

    /**
     * @var string|null
     *
     * @ORM\Column(name="siret", type="string", length=14, nullable=true)
     * @Assert\Length(
     *      min = 14,
     *      max = 14,
     *      minMessage = "Le numéro de SIRET doit contenir au minimum {{ limit }} caractères de long.",
     *      maxMessage = "Le numéro de SIRET ne doit pas dépasser {{ limit }} caractères.",
     *      exactMessage = "Le numéro de SIRET doit contenir {{ limit }} caractères."
     * )
     */
    private $siret;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "L'email ne doit pas dépasser {{ limit }} caractères."
     * )
     * @Assert\Email
     */
    private $email;

    /**
     * @var \ActivityArea
     *
     * @ORM\ManyToOne(targetEntity="ActivityArea")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_activity_area", referencedColumnName="id", nullable=true)
     * })
     */
    private $activityArea;

    /**
     * @var string|null
     *
     * @ORM\Column(name="source", type="string", length=5, nullable=true)
     */
    private $source;

    /**
     * @var \CompanyCategory
     *
     * @ORM\ManyToOne(targetEntity="CompanyCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_company_category", referencedColumnName="id")
     * })
     */
    private $idCompanyCategory;

    /**
     * @var string|null
     *
     * @ORM\Column(name="decision_level", type="integer", nullable=true, options={"fixed"=true})
     */
    private $decisionLevel;

    /**
     * @var \Salesperson
     *
     * @ORM\ManyToOne(targetEntity="Salesperson")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_salesperson", referencedColumnName="code", onDelete="SET NULL")
     * })
     */
    private $idSalesperson;

    /**
     * @var \LegalStatus
     *
     * @ORM\ManyToOne(targetEntity="LegalStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_legal_status", referencedColumnName="id")
     * })
     */
    private $idLegalStatus;

    /**
     * @var \NumberEmployees
     *
     * @ORM\ManyToOne(targetEntity="NumberEmployees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_number_employees", referencedColumnName="id")
     * })
     */
    private $numberEmployees;

    /**
     * @var Turnovers
     *
     * @ORM\ManyToOne(targetEntity="Turnovers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_turnovers", referencedColumnName="id")
     * })
     */
    private $turnovers;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Contacts", mappedBy="company")
     */
    private $contacts;

    /**
     * @var \Salesperson
     *
     * @ORM\ManyToOne(targetEntity="Salesperson")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_last_update", referencedColumnName="code")
     * })
     */
    private $user_last_update;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contacts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCompanyStatus(): ?CompanyStatus
    {
        return $this->companyStatus;
    }

    public function setCompanyStatus(?CompanyStatus $companyStatus): self
    {
        $this->companyStatus = $companyStatus;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(?bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(?string $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getCreatedAtCompany(): ?\DateTimeInterface
    {
        return $this->createdAtCompany;
    }

    public function setCreatedAtCompany(?\DateTimeInterface $createdAtCompany): self
    {
        $this->createdAtCompany = $createdAtCompany;

        return $this;
    }

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getNafCode(): ?string
    {
        return $this->nafCode;
    }

    public function setNafCode(?string $nafCode): self
    {
        $this->nafCode = $nafCode;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getActivityArea(): ?ActivityArea
    {
        return $this->activityArea;
    }

    public function setActivityArea(?ActivityArea $activityArea): self
    {
        $this->activityArea = $activityArea;

        return $this;
    }

    public function getIdCompanyCategory(): ?CompanyCategory
    {
        return $this->idCompanyCategory;
    }

    public function setIdCompanyCategory(?CompanyCategory $idCompanyCategory): self
    {
        $this->idCompanyCategory = $idCompanyCategory;

        return $this;
    }

    public function getIdSalesperson(): ?Salesperson
    {
        return $this->idSalesperson;
    }

    public function setIdSalesperson(?Salesperson $idSalesperson): self
    {
        $this->idSalesperson = $idSalesperson;

        return $this;
    }

    public function getLegalStatus(): ?LegalStatus
    {
        return $this->idLegalStatus;
    }

    public function getIdLegalStatus(): ?LegalStatus
    {
        return $this->idLegalStatus;

    }

    public function setIdLegalStatus(?LegalStatus $idLegalStatus): self
    {
        $this->idLegalStatus = $idLegalStatus;

        return $this;
    }

    public function getNumberEmployees(): ?NumberEmployees
    {
        return $this->numberEmployees;
    }

    public function getIdNumberEmployees(): ?NumberEmployees
    {
        return $this->numberEmployees;
    }

    public function setNumberEmployees(?NumberEmployees $numberEmployees): self
    {
        $this->numberEmployees = $numberEmployees;

        return $this;
    }

    /**
     * @return Turnovers
     */
    public function getTurnovers(): ?Turnovers
    {
        return $this->turnovers;
    }

    /**
     * Set the value of turnovers
     *
     * @param  Turnovers $turnovers
     *
     * @return  self
     */
    public function setTurnovers(?Turnovers $turnovers)
    {
        $this->turnovers = $turnovers;

        return $this;
    }

    /**
     * @return Collection|Contacts[]
     */
    public function getIdContact(): Collection
    {
        return $this->contacts;
    }

    public function addIdContact(Contacts $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->addIdCompany($this);
        }

        return $this;
    }

    public function removeIdContact(Contacts $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            $contact->removeIdCompany($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getDecisionLevel(): ?int
    {
        return $this->decisionLevel;
    }

    public function setDecisionLevel($decisionLevel): self
    {
        $this->decisionLevel = $decisionLevel;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        // Only change the updated af if the file is really uploaded to avoid database updates.
        // This is needed when the file should be set when loading the entity.
        if ($this->imageFile instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getNombreContacts(): int
    {
        return count($this->contacts);
    }

    /**
     * Get the value of user_last_update
     *
     * @return  \Salesperson
     */
    public function getUser_last_update()
    {
        return $this->user_last_update;
    }

    /**
     * Set the value of user_last_update
     *
     * @param  \Salesperson  $user_last_update
     *
     * @return  self
     */
    public function setUser_last_update(Salesperson $user_last_update)
    {
        $this->user_last_update = $user_last_update;

        return $this;
    }

}
