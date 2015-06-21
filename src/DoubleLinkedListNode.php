<?php namespace Mtkocak\Algorithms;

class DoubleLinkedListNode implements DataStructureNodeInterface
{
    /* Data to hold */
    public $data;
    
    /* Link to next node */
    public $next;
    
    
    /* Node constructor */
    function __construct($data)
    {
        $this->data = $data;
        $this->next = NULL;
        $this->prev = NULL;
    }
    
    public function readNode()
    {
        return $this->data;
    }
}
