<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Diploma::class, orphanRemoval: true)]
    private $diplomas;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Hobbie::class, orphanRemoval: true)]
    private $hobbies;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: LanguageSpoken::class, orphanRemoval: true)]
    private $languageSpokens;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: PersonalInformation::class, orphanRemoval: true)]
    private $personalInformation;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ProfessionalExperience::class, orphanRemoval: true)]
    private $professionalExperiences;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Skill::class, orphanRemoval: true)]
    private $skills;

    public function __construct()
    {
        $this->diplomas = new ArrayCollection();
        $this->hobbies = new ArrayCollection();
        $this->languageSpokens = new ArrayCollection();
        $this->personalInformation = new ArrayCollection();
        $this->professionalExperiences = new ArrayCollection();
        $this->skills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Diploma>
     */
    public function getDiplomas(): Collection
    {
        return $this->diplomas;
    }

    public function addDiploma(Diploma $diploma): self
    {
        if (!$this->diplomas->contains($diploma)) {
            $this->diplomas[] = $diploma;
            $diploma->setUser($this);
        }

        return $this;
    }

    public function removeDiploma(Diploma $diploma): self
    {
        if ($this->diplomas->removeElement($diploma)) {
            // set the owning side to null (unless already changed)
            if ($diploma->getUser() === $this) {
                $diploma->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Hobbie>
     */
    public function getHobbies(): Collection
    {
        return $this->hobbies;
    }

    public function addHobby(Hobbie $hobby): self
    {
        if (!$this->hobbies->contains($hobby)) {
            $this->hobbies[] = $hobby;
            $hobby->setUser($this);
        }

        return $this;
    }

    public function removeHobby(Hobbie $hobby): self
    {
        if ($this->hobbies->removeElement($hobby)) {
            // set the owning side to null (unless already changed)
            if ($hobby->getUser() === $this) {
                $hobby->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LanguageSpoken>
     */
    public function getLanguageSpokens(): Collection
    {
        return $this->languageSpokens;
    }

    public function addLanguageSpoken(LanguageSpoken $languageSpoken): self
    {
        if (!$this->languageSpokens->contains($languageSpoken)) {
            $this->languageSpokens[] = $languageSpoken;
            $languageSpoken->setUser($this);
        }

        return $this;
    }

    public function removeLanguageSpoken(LanguageSpoken $languageSpoken): self
    {
        if ($this->languageSpokens->removeElement($languageSpoken)) {
            // set the owning side to null (unless already changed)
            if ($languageSpoken->getUser() === $this) {
                $languageSpoken->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PersonalInformation>
     */
    public function getPersonalInformation(): Collection
    {
        return $this->personalInformation;
    }

    public function addPersonalInformation(PersonalInformation $personalInformation): self
    {
        if (!$this->personalInformation->contains($personalInformation)) {
            $this->personalInformation[] = $personalInformation;
            $personalInformation->setUser($this);
        }

        return $this;
    }

    public function removePersonalInformation(PersonalInformation $personalInformation): self
    {
        if ($this->personalInformation->removeElement($personalInformation)) {
            // set the owning side to null (unless already changed)
            if ($personalInformation->getUser() === $this) {
                $personalInformation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ProfessionalExperience>
     */
    public function getProfessionalExperiences(): Collection
    {
        return $this->professionalExperiences;
    }

    public function addProfessionalExperience(ProfessionalExperience $professionalExperience): self
    {
        if (!$this->professionalExperiences->contains($professionalExperience)) {
            $this->professionalExperiences[] = $professionalExperience;
            $professionalExperience->setUser($this);
        }

        return $this;
    }

    public function removeProfessionalExperience(ProfessionalExperience $professionalExperience): self
    {
        if ($this->professionalExperiences->removeElement($professionalExperience)) {
            // set the owning side to null (unless already changed)
            if ($professionalExperience->getUser() === $this) {
                $professionalExperience->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Skill>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->setUser($this);
        }

        return $this;
    }

    public function removeSkill(Skill $skill): self
    {
        if ($this->skills->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getUser() === $this) {
                $skill->setUser(null);
            }
        }

        return $this;
    }
}
