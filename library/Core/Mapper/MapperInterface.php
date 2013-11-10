<?php

namespace Core\Mapper;

/**
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
     * @return array of entity
     */
    public function findBy($params);
    
    /**
     * Find row
     * 
     * @param array $params
     * @return entity
     */
    public function findOne($params);
    
    /**
     * Create new row
     * 
     * @param entity $entity
     * @return entity
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
