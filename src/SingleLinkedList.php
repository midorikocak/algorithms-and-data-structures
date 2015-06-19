<?php namespace Mtkocak\Algorithms;

class SingleLinkedList implements DataStructureInterface
{
    /* Link to the first node in the list */
    private $firstNode;
    
    /* Link to the last node in the list */
    private $lastNode;
    
    /* Total nodes in the list */
    private $count;
    
    private $current;
    
    function __construct(){
        $this->init();
    }
    
    public function init(){
        $this->firstNode = NULL;
        $this->lastNode = NULL;
        $this->current = $this->firstNode;
        $this->count = 0;
    }
    
    public function current(){
        return $this->current;
    }
    
    public function next(){
        $this->current = $this->current->next;
        return $this->current();
    }
    
    public function reset(){
        $this->current = $this->firstNode;
        return $this->current;
    }
    
    
    /**
     * Single Linked List does not have a prev function, so we cannot use it.
     * 
     */
    public function prev(){
        return false;
    }
    
    public function add($value){
        $newNode = new SingleLinkedListNode($value);
        
        if($this->isEmpty()){
            $this->firstNode = $newNode;
            $this->lastNode = $newNode;
            $this->count++;
            $this->current = $newNode;
        }
        else{
            $this->lastNode->next = $newNode;
            $this->lastNode = &$newNode;
            $this->count++;
            $this->current = $newNode;
        }
    }
    
    public function getData($position = NULL){
        if(!$this->isEmpty() && !isset($position)){
            return $this->lastNode->readNode();
        }
        elseif(!$this->isEmpty())
        {
            $this->reset();
            $currentPosition = 0;
            if($position == 0){
                return $this->current->readNode();
            }
            while($position != $currentPosition)
            {
                if(($currentPosition+1)==$position){
                    return $this->current->next->readNode();
                }
                elseif($this->current->next != NULL)
                {
                    $this->next();
                    $currentPosition++;
                }
            }
        }
        else{
            return false;
        }
    }
    
    public function isEmpty(){
        
        // return ($this->firstNode == NULL); // Same as above. Better Readability
        if($this->firstNode == NULL){
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
        $listData = array();
        $this->reset();
        while($this->current != NULL)
        {
            array_push($listData, $this->current->readNode());
            $this->current = $this->current->next;
        }
        return $listData;
    }
    
    /**
    *
    * @param unknown $value
     */
     public function search($value){
         $listData = array();
         $this->reset();
         $position = 0;
         if($this->isEmpty()){
             return false;
         }
         
         if($this->current->data == $value){
             return 0;
         }
         while($this->current->data != $value)
         {
             if($this->current->next->data==$value){
                  return $position+1;
             }
             $this->next();
             $position++;
         }
         return false;
     }
    
    /**
    *
    * @param string $position
    */
    public function delete($position = NULL){
        if(!$this->isEmpty() && !isset($position)){
              $this->reset();
              while($this->current->next != NULL){
                  if($this->current->next->next == NULL){
                      $nextToDelete = $this->current->next;
                      unset($nextToDelete);
                      $this->lastNode = $this->current;
                      $this->current->next == NULL;
                      return true;
                  }
                  $this->next();
              }
        }
        elseif(!$this->isEmpty())
        {
            $this->reset();
            $currentPosition = 0;
            if($position == 0){
                $newFirstNode = $this->firstNode->next;
                unset($this->firstNode);
                $this->firstNode = $newFirstNode;
                return true;
            }
            while($position != $currentPosition)
            {
                if(($currentPosition+1)==$position){
                    $newNext = $this->current->next;
                    unset ($this->current);
                    return true;
                }
                elseif($this->current->next != NULL)
                {
                    $this->next();
                    $currentPosition++;
                }
            }
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
    public function setData($value,$position = NULL){
        if(!$this->isEmpty() && !isset($position)){
            $this->lastNode->data = $value;
            return true;
        }
        elseif(!$this->isEmpty())
        {
            $this->reset();
            $currentPosition = 0;
            if($position == 0){
                $this->current->data = $value;
                return true;
            }
            while($position != $currentPosition)
            {
                if(($currentPosition+1)==$position){
                    $this->current->next->data = $value;
                    return true;
                }
                elseif($this->current->next != NULL)
                {
                    $this->next();
                    $currentPosition++;
                }
            }
        }
        else{
            return false;
        }
    }

}
