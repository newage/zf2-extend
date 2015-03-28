<?php
namespace Core\Mapper;

/**
 *
 * @author V.Leontiev
 */
interface MapperInterface
{

    /**
     * Find one row by id
     *
     * @param int $id            
     * @return entity
     */
    public function find($id);

    /**
     * Find rows
     *
     * @param array $params
     * @param array $order
     * @param int $limit
     * @return array of entity
     */
    public function findBy(array $params, array $order = null, $limit = null);

    /**
     * Find row
     *
     * @param array $params            
     * @return entity
     */
    public function findOne(array $params);

    /**
     * Create new row
     *
     * @param object $entity
     * @return bool|int
     */
    public function create($entity);

    /**
     * Delete row
     *
     * @param int $id            
     * @return entity
     */
    public function delete($id);

    /**
     * Update row
     *
     * @param entity $entity            
     * @return entity
     */
    public function update($entity);
}
