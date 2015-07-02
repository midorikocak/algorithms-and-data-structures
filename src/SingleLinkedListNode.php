<?php namespace Mtkocak\DataStructures;

class SingleLinkedListNode implements DataStructureNode
{
    private $data;
    
    public $next;
    
    function __construct($data)
    {
        $this->data = $data;
        $this->next = NULL;
    }
    
    public function get()
    {
        return $this->data;
    }
    
    public function set($value)
    {
        $this->data = $value;
        return $this->data;
    }
    
    public function next(DataStructureNode $node = NULL)
    {
        if(isset($node))
        {
            $this->next = $node;
        }
        return $this->next;
    }
}
