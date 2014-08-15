<?php

/**
 * This is part of Blacklist CMS developed by Beepvix.
 *
 * @date 31.05.2014
 * @author Томас Петр <tomas.petr@beepvix.com>
 * @package Blacklist\Object
 */
    
namespace
    Blacklist\Object;

use
    Nette\Http\FileUpload,
    Nette\Object as NObject;
use Nette\Utils\Strings;

/**
 * This class exists only for better image management, 
 * which offers Nette. Mainly because it generates a 
 * prefix name to avoid overwriting an existing file.
 *
 * @author Томас Петр <www.beepvix.com>
 */
class ImageFactory extends NObject
{
    
    /** @var type string */
    private $name = NULL;
    
    /** @var type int */
    private $size = NULL;
    
    /** @var \Nette\Http\FileUpload */
    private $image = NULL;
    
    /** @var type string */
    private $path = NULL;

    /**
     * @param \Nette\Http\FileUpload $image
     */
    public function __construct(FileUpload $image)
    {
        $this->name   = (string) $image->name;
        $this->size   = (int) $image->size;
        $this->image  = (object) $image;
    }
    
    /** 
     * @param type $name string
     */
    public function setName($name)
    {
        $this->name = (string) $name;
    }
    
    /**
     * @return type int
     */
    public function getSize()
    {
        return (int) $this->size;
    }
    
    /**
     * @return \Nette\Http\FileUpload
     */
    public function getImage()
    {
        return (object) $this->image;
    }
    
    /**
     * @return type string
     */
    public function getName()
    {
        return (string) $this->name;
    }
    
    /**
     * @return type string
     */
    public function getPath()
    {
        return (string) $this->path;
    }
    
    /**
     * This method upload the file to the server in a folder that 
     * is defined in the variable "PATH". If not completed, it will 
     * be set to default "www/images/".
     */
    public function upload($path = NULL)
    {
        if($this->image->name !== null)
        {
            $path = ($path === NULL) ? 'images/' : $path;
            $name = $this->getPrefixedName($path);
            $this->image->move($path . $name);
        }
    }
    
    /**
     * This method returns fixed name (if this image already exists)...
     */
    private function getPrefixedName($path)
    {
        $prefix = 1;
        $this->name = \Nette\Utils\Strings::webalize($this->name);
        $name = (string) $this->name;
        while(\file_exists( $path . $name))
        {
            $name = "($prefix)" . $this->name;
            $prefix++;
        }
        $this->path = (string) $path;
        return (string) $name;
    }
}