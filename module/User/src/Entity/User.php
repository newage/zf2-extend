<?php
namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{

    const SECRET_KEY = 'secret key for user';

    const STATUS_ENABLE = 'ENABLE';
    const STATUS_DISABLE = 'DISABLE';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $identifier;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="string")
     */
    protected $salt;

    /**
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     */
    protected $role;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at", nullable=true)
     */
    protected $updatedAt;

    /**
     * @ORM\Column(type="string", name="password_hash", nullable=true)
     */
    protected $passwordHash;

    /**
     * @ORM\Column(type="string")
     */
    protected $status;

    public function getId()
    {
        return $this->id;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setSalt($salt)
    {
        $this->salt = $salt;
        return $this;
    }

    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime("now");
        return $this;
    }

    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime("now");
        return $this;
    }

    public function setPasswordHash()
    {
        $this->passwordHash = md5(time() . uniqid());
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}
