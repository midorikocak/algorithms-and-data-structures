<?php namespace Mtkocak\DataStructures;

class Queue
{
    public $head;
    public $tail;
    
    function __construct(){
        $this->head = NULL;
        $this->tail = NULL;
    }
    
    public function enqueue($value){
        $newNode = new SingleLinkedListNode($value);
        if($this->isEmpty())
        {
            $this->head = $newNode;
            $this->tail = $newNode;
        }else{
            $currentTail = $this->tail;
            $newNode->next($currentTail);
            $this->tail = $newNode;
        }
    }
    
    public function dequeue(){
        $current = $this->tail;
        if($current == $this->head){
            $this->tail = NULL;
            $this->head = NULL;
            return $current->get();
        }
        while($current){
            if($current->next() == $this->head){
                $nodeToDelete = $this->head;
                $this->head = $current;
                $current->next = NULL;
                return $nodeToDelete->get();
            }
            $current = $current->next();
        }
        return false;
    }
    
    public function listAll(){
        $current = $this->tail;
        $listToReturn = [];
        while($current){
            array_push($listToReturn, $current->get()->get());
            $current = $current->next();
        }
        return $listToReturn;
    }
    
    public function peek(){
        return $this->head->get();
    }
    
    public function isEmpty(){
        if($this->head == NULL){
            return true;
        }
        else{
            return false;
        }
    }
}
