<?php

namespace App\Entity;



use App\Repository\UserRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'users')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{

    const STATUS_DISABLED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_VIP = 2;

    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    private int $id;

    #[ORM\Column(length: 60)]
    private string $login;

    #[ORM\Column()]
    private string $password;

    #[ORM\OneToMany(targetEntity: Phone::class, mappedBy: 'user', fetch: 'LAZY')]
    private Collection $phones;

    #[ORM\Column(type: Types::SMALLINT)]
    private int $status = 0;

    #[ORM\Column(length: 60, unique: true, nullable: false)]
    private string $email;

//    #[ORM\Column(length: 32, unique: true, nullable: false)]
//    private string $apiToken;

    /**
     * @param string $email
     * @param string $password
     * @param int $status
     */
    public function __construct(string $email, string $password, int $status = self::STATUS_DISABLED)
    {
        $this->phones = new ArrayCollection();
        $this->email = $email;
        $this->changePassword($password);
        $this->status = $status;
//        $this->generateApiToken();
    }

    public function setEmail(string $email): static  //! potential problem
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function changeLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function changePassword(string $password): void
    {
        $this->password = $password;
    }

    public function isActiveUser(): bool
    {
        return $this->status === static::STATUS_ACTIVE;
    }

    public function isDisabledUser(): bool
    {
        return $this->status === static::STATUS_DISABLED;
    }

    public function isVIPUser(): bool
    {
        return $this->status === static::STATUS_VIP;
    }

    public function setStatusDisabled(): void
    {
        $this->status = static::STATUS_DISABLED;
    }

    public function setStatusActive(): void
    {
        $this->status = static::STATUS_ACTIVE;
    }

    public function setStatusVIP(): void
    {
        $this->status = static::STATUS_VIP;
    }


    /**
     * @return Collection
     */
    public function getPhones(): Collection
    {
        return $this->phones;
    }

    /**
     * @param Phone $phone
     */
    public function addPhone(Phone $phone): void
    {
        $this->phones->add($phone);
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->getEmail();
    }

    public function getApiToken(): string
    {
        return $this->apiToken;
    }

    public function generateApiToken(): static
    {
        $this->apiToken = md5(mt_rand() . (new DateTime())->getTimestamp());

        return $this;
    }

}
