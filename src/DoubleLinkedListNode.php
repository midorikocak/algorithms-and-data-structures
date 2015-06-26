<?php namespace Mtkocak\DataStructures;

class DoubleLinkedListNode implements DataStructureNode
{
    private $data;
    
    private $next;
    
    private $prev;
    
    
    function __construct($data)
    {
        $this->data = $data;
        $this->next = NULL;
        $this->prev = NULL;
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
    
    public function prev(DataStructureNode $node = NULL)
    {
        if(isset($node))
        {
            $this->prev = $node;
        }
        return $this->prev;
    }
}
