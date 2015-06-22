<?php
namespace Mtkocak\Algorithms;

class DoubleLinkedList implements DataStructureInterface
{
    /* Link to the first node in the list */
    private $firstNode;
    
    /* Link to the last node in the list */
    private $lastNode;

    private $current;

    function __construct()
    {
        $this->init();
    }
    
    function __toString(){
        return print_r($this->listAll(),true);
    }

    public function init()
    {
        $this->firstNode = NULL;
        $this->lastNode = NULL;
        $this->current = $this->firstNode;
        $this->count = 0;
    }

    public function current()
    {
        return $this->current;
    }

    public function next()
    {
        $this->current = $this->current->next;
        return $this->current();
    }

    public function reset()
    {
        $this->current = $this->firstNode;
        return $this->current;
    }

    public function prev()
    {
        $this->current = $this->current->prev;
        return $this->current;
    }

    /**
     * Using prev adding is easier
     * 
     * @see \Mtkocak\Algorithms\DataStructureInterface::add()
     */
    public function add($value)
    {
        $newNode = new DoubleLinkedListNode($value);
        if ($this->isEmpty()) {
            $this->firstNode = $newNode;
            $this->lastNode = $newNode;
        } else {
            $oldLastNode = $this->lastNode;
            $newNode->prev = $oldLastNode;
            $oldLastNode->next = $newNode;
            $this->lastNode = $newNode;
        }
    }

    public function goToPosition($position)
    {
        // can use prev without resetting
        // but we should know current position but we don't have a counter
        // any suggestions?
        $this->reset();
        $currentPosition = 0;
        if (! $this->isEmpty() && $position == 0) {
            $this->reset();
            return true;
        }
        while ($this->current->next != NULL && $currentPosition != $position) {
            $this->next();
            $currentPosition ++;
            if ($position == ($currentPosition + 1)) {
                $this->next();
                return true;
            }
        }
        return false;
    }

    public function getData($position = NULL)
    {
        if (! $this->isEmpty() && ! isset($position)) {
            return $this->lastNode->readNode();
        } elseif (! $this->isEmpty() && isset($position)) {
            // more readable thx to goToPosition();
            $this->goToPosition($position);
            return $this->current->readNode();
        } else {
            return false;
        }
    }

    public function isEmpty()
    {
        
        // return ($this->firstNode == NULL); // Same as above. Better Readability
        if ($this->firstNode == NULL) {
            return true;
        } else {
            return false;
        }
    }

    /**
     */
    public function listAll()
    {
        $listData = [];
        if (! $this->isEmpty()) {
            $this->reset();
            while ($this->current->next != NULL) {
                array_push($listData, $this->current->readNode());
                $this->next();
            }
            if ($this->current->next == NULL) {
                array_push($listData, $this->current->readNode());
            }
        }
        return $listData;
    }

    /**
     * Recursive Search Function
     *
     * @param unknown $value            
     */
    public function search($value, $node = null, $position = null)
    {
        // check empty
        if ($this->firstNode == NULL) {
            return false;
        }
        
        // first call
        if ($position == NULL && $node == null) {
            $this->reset();
            $node = $this->firstNode;
            $position = 0;
        }
        
        if ($node != null) {
            if ($node->readNode() == $value) {
                return $position;
            } else {
                if ($node->next != NULL) {
                    $position ++;
                    return $this->search($value, $node->next, $position);
                }
            }
        }
        return false;
    }

    /**
     *
     * With prev variable, deleting is easier
     *
     * @param string $position            
     */
    public function delete($position = NULL)
    {
        if($position!=null){
            // Check Empty
            if($this->lastNode!=NULL){
                
                // Delete last node;
                $oldLastNode = $this->lastNode;
                $this->lastNode = $oldLastNode->prev;
                unset($oldLastNode);
                $this->lastNode->next = NULL;
                return true;
            }
        }else{
            $this->goToPosition($position);            
            $nodeToDelete = $this->current;
            if($this->current->next!=NULL)
            {
                $nextNode = $this->current->next;
                $nextNode->prev = $this->current->prev;
            }
            if($this->current->prev!=NULL)
            {
                $prevNode = $this->current->prev;
                $prevNode->next = $this->current->next;
            }
            
            unset($nodeToDelete);
            return true;      
        }
        return false;
    }

    /**
     *
     * @param string $position            
     * @param unknown $value            
     */
    public function setData($value, $position = NULL)
    {
        if($position==null)
        {
            $this->reset();
        }
        else
        {
            $this->goToPosition($position);
        }
       
        if(!$this->isEmpty()){
            $this->current->data == $value;
            return true;
        }
        return false;
    }
}
