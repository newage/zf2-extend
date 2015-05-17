<?php

namespace Core\Mapper;

use Core\Entity\EntityInterface;

/**
 *
 * @author V.Leontiev
 */
interface MapperInterface
{

    /**
     * Find one row by id

     * @param int $identifier
     * @return EntityInterface
     */
    public function find($identifier);

    /**
     * Find rows
     * @param array $params
     * @param array $order
     * @param int $limit
     * @return array of entity
     * @internal param array|EntityInterface $entity
     * @internal param array $params
     */
    public function findBy(array $params, array $order = null, $limit = null);

    /**
     * Find row
     * @param array|\Core\Entity\EntityInterface $params
     * @return \Core\Entity\EntityInterface
     */
    public function findOne(array $params);

    /**
     * Create new row
     * @param EntityInterface $entity
     * @return bool|int
     */
    public function create(EntityInterface $entity);

    /**
     * Delete row

     * @param int $identifier
     * @return EntityInterface
     */
    public function delete($identifier);

    /**
     * Update row
     * @param EntityInterface $entity
     * @return \Core\Entity\EntityInterface
     */
    public function update(EntityInterface $entity);
}
