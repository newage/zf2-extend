<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Roles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    
    /**
     * @ORM\OneToOne(targetEntity="Roles")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * @ORM\Column(type="integer", name="parent_id")
     */
    protected $parentId;
    
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getParentId()
    {
        return $this->parentId;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
        return $this;
    }


}
