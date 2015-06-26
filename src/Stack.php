<?php
namespace Mtkocak\DataStructures;

class Stack
{
    private $top;
    private $bottom;

    function __construct()
    {
        $this->top = NULL;
        $this->bottom = NULL;
    }

    public function isEmpty()
    {
        if ($this->top == NULL) {
            return true;
        } else {
            return false;
        }
    }
    
    public function push($value){
        $newNode = new SingleLinkedListNode($value);
        if($this->isEmpty()){
            $this->top = $newNode;
            $this->tbottom = $newNode;
            return true;
        }else{
            $oldTop = $this->top;
            $this->top = $newNode;
            $newNode->next($oldTop);
            return true;
        }
        return false;
    }
    
    public function pop(){
        if(!$this->isEmpty()){
            $top = $this->top;
            $value = $top->get();
            $this->top = $top->next();
            unset($top);
            return $value;
        }else{
            return false;
        }
    }

    public function peek(){
        return $this->top->get();
    }
}
