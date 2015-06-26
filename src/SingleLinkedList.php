<?php namespace Mtkocak\DataStructures;

class SingleLinkedList extends LinkedList
{
    
    public function push($value){
        $newNode = new SingleLinkedListNode($value);
        
        if($this->isEmpty()){
            $this->bottom($newNode);
            $this->top($newNode);
        }
        else{
            $this->top->next($newNode);
            $this->top($newNode);
        }
        $this->count++;
    }
    
    /**
    * Deletes from end, and returns value.
    */
    public function pop(){
        $this->rewind();
        $value = NULL;
        if(!$this->isEmpty()){
            if($this->current->next()==NULL){
                $nodeToDelete = $this->current;
                $value = $nodeToDelete->get();
                $this->top(NULL);
                $this->bottom(NULL);
                unset($nodeToDelete);
                return $value;
            }
            while($this->current->next()!=NULL)
            {
                if($this->current->next()->next() == NULL){
                    $nextToDelete = $this->current->next();
                    $value = $nextToDelete->get();
                    unset($nextToDelete);
                    $this->top($this->current);
                    $this->current->next(NULL);
                }
            
                $this->next();
            }
            return $value;
        }
        return false;
    }
    
    /**
    * Add to beginning. Reverse of push();
    */
    public function add($value){
        $newNode = new SingleLinkedListNode($value);
        
        if($this->isEmpty()){
            $this->bottom = $newNode;
            $this->top = $newNode;
            $this->count++;
            return true;
        }
        else{
            $currentBottom = $this->bottom;
            $this->bottom = &$newNode;
            $this->bottom->next($currentBottom);
            $this->count++;
            return true;
        }
        return false;
    }
    
    public function insertAfter($key, $value){
        $newNode = new SingleLinkedListNode($value);
        $this->rewind();
        $currentKey = 0;
        while($this->current){
            if($currentKey==$key){
                $next = $this->current->next();
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
        $newNode = new SingleLinkedListNode($value);
        $this->rewind();
        $currentKey = 0;
        while($this->current && $currentKey!=$key){
            if(($currentKey+1)==$key){
                $nodeToInsertBefore = $this->current->next();
                $this->current->next($newNode);
                $newNode->next($nodeToInsertBefore);
                return true;
            }
            $this->next();
            $currentKey++;
        }
        return false;
    }
    
    /**
    * Delete from beginning. Reverse of pop();
    */
    public function delete(){
        if(!$this->isEmpty()){
            $nodeToDelete = $this->bottom;
            $value = $nodeToDelete->get();
            $newBottom = $nodeToDelete->next();
            $this->bottom($newBottom);
            return $value;
        }
        return false;
    }
}
