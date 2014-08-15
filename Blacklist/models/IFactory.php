<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 11.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Factory
 */
    
namespace
    Blacklist\Factory;
 
/**
 * This interface serves as the interface for all system object factories.
 * 
 * @author Томас Петр
 */
interface IFactory
{
    public function getById($id);
    public function getRowBy($conditions);
    public function getArrayBy($conditions, $limit = NULL);
    public function getAll($limit = NULL, $conditions = NULL);
}