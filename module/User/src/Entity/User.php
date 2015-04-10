<?php
namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{

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
     * @ORM\Column(type="integer", name="is_enable")
     */
    protected $isEnable;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->primary;
    }

    /**
     * @param mixed $primary
     */
    public function setId($primary)
    {
        $this->primary = $primary;
    }

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param mixed $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     *
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime("now");
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     *
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime("now");
    }

    /**
     * @return mixed
     */
    public function getRestoreHash()
    {
        return $this->restoreHash;
    }

    /**
     *
     */
    public function setRestoreHash()
    {
        $this->restoreHash = sha1(time() . uniqid());;
    }

    /**
     * @return bool
     */
    public function isEnable()
    {
        return $this->isEnable == 1;
    }

    /**
     * Set enable flag
     */
    public function setEnable()
    {
        $this->isEnable = 1;
    }

    /**
     * Set disable flag
     */
    public function setDisable()
    {
        $this->isEnable = 0;
    }

    /**
     * @return string
     */
    public function getRestoreHashUpdatedAt()
    {
        return $this->restoreHashUpdatedAt;
    }

    /**
     *
     */
    public function setRestoreHashUpdatedAt()
    {
        $this->restoreHashUpdatedAt = new \DateTime("now");;
    }
}
