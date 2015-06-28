<?php namespace Mtkocak\DataStructures;

class DoubleLinkedList extends LinkedList
{
    
    public function push($value){
        $newNode = new DoubleLinkedListNode($value);
        
        if($this->isEmpty()){
            $this->bottom($newNode);
            $this->top($newNode);
        }
        else{
            $oldTop = $this->top;
            $oldTop->next($newNode);
            $newNode->prev($oldTop);
            $this->top($newNode);
        }
        $this->count++;
    }
    
    /**
    * Deletes from end, and returns value.
    */
    public function pop(){
        if(!$this->isEmpty()){
            $this->rewind();
        
            $nodeToDelete = $this->top;
            $value = $nodeToDelete->get();
            $this->top($nodeToDelete->prev());
            $this->top->next = NULL;
        
            unset($nodeToDelete);
            
            return $value;
        }
        return false;
    }
    
    /**
    * Add to beginning. Reverse of push();
    */
    public function add($value){
        $newNode = new DoubleLinkedListNode($value);
        
        if($this->isEmpty()){
            $this->bottom = $newNode;
            $this->top = $newNode;
            $this->count++;
            return true;
        }
        else{
            $currentBottom = $this->bottom;
            $currentBottom->prev($newNode);
            $this->bottom = &$newNode;
            $this->bottom->next($currentBottom);
            $this->count++;
            return true;
        }
        return false;
    }
    
    public function insertAfter($key, $value){
        $newNode = new DoubleLinkedListNode($value);
        $this->rewind();
        $currentKey = 0;
        while($this->current){
            if($currentKey==$key){
                $next = $this->current->next();
                $next->prev($newNode);
                $this->current->next($newNode);
                $newNode->next($next);
                return true;
            }
            $this->next();
            $currentKey++;
        }
        return false;
    }
    
    public function insertBefore($key, $value){
        $newNode = new DoubleLinkedListNode($value);
        $this->rewind();
        $currentKey = 0;
        while($this->current){
            if($currentKey==$key){
                $prev = $this->current->prev();
                $prev->next($newNode);
                $this->current->prev($newNode);
                $newNode->prev($prev);
                return true;
            }
            $this->next();
            $currentKey++;
        }
        return false;
    }
    
    public function offsetUnset(  $offset ){
        $counter = 0;
        $current = $this->bottom;
        while($current){
            if($counter == $offset){
                $next = $current->next();
                $prev = $current->prev();
            
                if($this->count()==1){
                    $this->top = NULL;
                    $this->bottom = NULL;
                }elseif($counter == $this->count()){
                    $this->top = $prev;
                }else{
                    $prev->next($next);
                    $next->prev($prev);
                }
                $current = NULL;
                return true;
            }
            $counter++;
            $current = $current->next();
        }
        throw new \OutOfBoundsException();
    }
    
    /**
    * Delete from beginning. Reverse of pop();
    */
    public function delete(){
        if(!$this->isEmpty()){
            $nodeToDelete = $this->bottom;
            $value = $nodeToDelete->get();
            $newBottom = $nodeToDelete->next();
            if($newBottom!=NULL){
                $newBottom->prev = NULL;
            }
            $this->bottom = $newBottom;
            if($this->isEmpty()){
                $this->top = NULL;
            }
            return $value;
        }
        return false;
    }
}
