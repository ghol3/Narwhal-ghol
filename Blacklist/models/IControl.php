<?php
    
/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 11.06.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Object
 */
    
namespace
    Blacklist\Object;
 
/**
 * This interface serves as the interface for all system objects.
 * 
 * @author Томас Петр
 */
interface IObject
{
    public function create();
    public function update();
    public function remove();
}