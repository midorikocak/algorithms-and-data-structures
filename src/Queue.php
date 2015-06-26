<?php namespace Mtkocak\DataStructures;

class Queue
{
    /* The pointer in a queue always points to last element  */
    private $head;
    private $tail;
    
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
            $currentHead = $this->head;
            $newNode->next($currentHead);
            $this->head($newNode);
        }
    }
    
    public function dequeue(){
        $nodeToDelete = $this->tail;
        if(!$this->isEmpty()){
            $value = $nodeToDelete->get();
            $current = $this->head;
            if($current->next()==NULL){
                $this->tail = NULL;
                $this->head = NULL;
                unset($nodeToDelete);
                return $value;
            }
            while($current){
                // element before last
                if($current->next()->next()==NULL){
                    $this->tail = $current;
                    unset($nodeToDelete);
                    return $value;
                }
                $current = $current->next();
            }
        }
        return false;
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
