<?php

namespace Core\Entity;

/**
 * Interface EntityInterface
 * @package Core\Entity
 */
interface EntityInterface
{

    /**
     * Get identifier for entity
     * @return int
     */
    public function getId();

    /**
     * Set identifier for entity
     * @param $primary
     * @return $this
     */
    public function setId($primary);
}
