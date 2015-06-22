<?php namespace Mtkocak\Algorithms;

class Queue implements DataStructureInterface
{
    /* The pointer in a queue always points to last element  */
    private $pointer;
    
    function __construct(){
        $this->init();
    }
    
    public function init(){
        $this->pointer = NULL;
    }
    
    public function add($value,$position = null){
        $newNode = new SingleLinkedListNode($value);
        
        if($this->isEmpty()){
            $this->pointer = $newNode;
        }
        else{
            $oldLastNode = $this->pointer;
            $this->pointer = $newNode;
            $newNode->next = $oldLastNode;
            return true;
        }
    }
    
    public function getData($position = null){
        if(!$this->isEmpty())
        {
            return $this->pointer->readNode();
        }
        else{
            return false;
        }
    }
    
    public function isEmpty(){
        if($this->pointer == NULL){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     */
    public function listAll()
    {
        $listData = [];
        $currentNode = $this->pointer;
        if(!$this->isEmpty())
        {
            while($currentNode){
                array_push($listData, $currentNode->readNode());
                $currentNode = $currentNode->next;
            }
        }
        return $listData;
    }
    
    
    /**
    *
    * @param string $position
    */
    public function delete($position = null){
        if(!$this->isEmpty())
        {
            $nodeToDelete = $this->pointer;
            $this->pointer = $this->pointer->next;
            unset($nodeToDelete);
            return true;
        }
        else{
            return false;
        }
    }
    
    /**
    *
    * @param string $position
    * @param unknown $value
    */
    public function setData($value,$position = null){
        if(!$this->isEmpty())
        {
            $nodeToChange = $this->pointer;
            
            // at node we should implement getter and setter methods for better encapsulation
            $nodeToChange->data = $nodeToChange;
            return true;
        }
        else{
            return false;
        }
    }
    
	/**
	 * Not implemented because to have a basic queue structure.
	 * 
	 * TODO: Need to remove it from interface
	 * 
     * @see \Mtkocak\Algorithms\DataStructureInterface::search()
     */
    public function search($value)
    {
        // TODO Auto-generated method stub
        
    }


}
