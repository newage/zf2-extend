<?php
namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{

    const STATUS_ENABLE = 'ENABLE';
    const STATUS_DISABLE = 'DISABLE';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", name="id")
     */
    protected $primary;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $identifier;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

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
     * @ORM\Column(type="string", name="restore_hash", nullable=true)
     */
    protected $restoreHash;

    /**
     * @ORM\Column(type="datetime", name="restore_hash_updated_at", nullable=true)
     */
    protected $restoreHashUpdatedAt;

    /**
     * @ORM\Column(type="string", name="is_active")
     */
    protected $isActive;

    public function getId()
    {
        return $this->primary;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function getPassword()
    {
        return $this->password;
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

    public function getRestoreHash()
    {
        return $this->restoreHash;
    }

    public function getIsActive()
    {
        return $this->isActive;
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

    public function setRestoreHash()
    {
        $this->restoreHash = md5(time() . uniqid());
        return $this;
    }

    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRestoreHashUpdatedAt()
    {
        return $this->restoreHashUpdatedAt;
    }

    /**
     * @param mixed $restoreHashUpdatedAt
     */
    public function setRestoreHashUpdatedAt($restoreHashUpdatedAt)
    {
        $this->restoreHashUpdatedAt = $restoreHashUpdatedAt;
    }
}
