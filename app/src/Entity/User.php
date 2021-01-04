<?php declare(strict_types=1);
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity (repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements \Symfony\Component\Security\Core\User\UserInterface
{
    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private string $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private string $firstname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private string $lastname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private string $nickname;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private string $email;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private int $age;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100)
     */
    private string $password;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private \DateTime $create_date;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId( int $id ): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname( string $firstname ): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname( string $lastname ): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getNickname(): string
    {
        return $this->nickname;
    }

    /**
     * @param string $nickname
     */
    public function setNickname( string $nickname ): void
    {
        $this->nickname = $nickname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail( string $email ): void
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge( int $age ): void
    {
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @throws \Exception
     * @param string $password
     */
    public function setPassword( string $password ): void
    {
        $this->password = \App\lib\common::createHash( $password );
    }

    /**
     * @return string|null
     */
    public function getCreateDate(): ?string
    {
        return $this->create_date->format( \App\lib\consts::DATETIME_FORMAT_ESCAPED );
    }

    /**
     * @param \DateTime $create_date
     */
    public function setCreateDate( \DateTime $create_date ): void
    {
        $this->create_date = $create_date;
    }

    /**
     * @throws \Exception
     * @ORM\PrePersist()
     */
    public function beforeSave(): void
    {
        $this->create_date = new \DateTime('now', new \DateTimeZone('Europe/Kiev'));
    }


    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return array data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize(): array
    {
        return
            [
                'nickname'  => $this->getNickname(),
                'email'     => $this->getEmail()
            ];
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return [ 'ROLE_USER' ] ;
    }

    /**
     *
     */
    public function getSalt(): void
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     *
     */
    public function eraseCredentials(): void
    {

    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->getNickname();
    }
}