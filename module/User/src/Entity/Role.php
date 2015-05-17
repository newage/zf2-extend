<?php
namespace User\Entity;

use Core\Entity\EntityInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="roles")
 */
class Role implements EntityInterface
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", name="id")
     */
    protected $primary;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="integer", name="parent_id")
     */
    protected $parentId;

    /**
     * Get identifier for entity
     * @return int
     */
    public function getId()
    {
        return $this->getPrimary();
    }

    /**
     * Set identifier for entity
     * @param $primary
     * @return $this
     */
    public function setId($primary)
    {
        return $this->setPrimary($primary);
    }

    /**
     * @return mixed
     */
    public function getPrimary()
    {
        return $this->primary;
    }

    /**
     * @param mixed $primary
     */
    public function setPrimary($primary)
    {
        $this->primary = $primary;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param mixed $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }
}
