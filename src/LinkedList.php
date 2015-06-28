<?php
namespace Mtkocak\DataStructures;
use Exception;

abstract class LinkedList implements DataStructure, Listable, \Iterator , \ArrayAccess , \Countable
{

    /**
    * Last Element
    */
    public $top;

    /**
    * First Element
    */
    public $bottom;

    /**
    * Pointer Element
    */
    public $current;

    public $count = NULL;
    
    public $key;

    public function __construct()
    {
        $this->top = NULL;
        $this->bottom = NULL;
        $this->current = $this->bottom;
        $this->key = 0;
        $this->count = $this->count();
    }

    public function top(DataStructureNode $node = NULL)
    {
        if (isset($node)) {
            $this->top = $node;
        }
        return $this->top->get();
    }
    
    public function valid(){
        return $this->offsetExists($this->key);
    }
    
    
    public function offsetExists(  $offset ){
        $counter = 0;
        $current = $this->bottom;
        while($current){
            if($counter == $offset){
                return true;
            }
            $counter++;
            $current = $current->next();
        }
        return false;
    }
    
    public function offsetGet(  $offset ){
        $counter = 0;
        $current = $this->bottom;
        while($current){
            if($counter == $offset){
                return $current->get();
            }
            $counter++;
            $current = $current->next();
        }
        throw new \OutOfBoundsException();
    }
    public function offsetSet(  $offset ,  $value ){
        $counter = 0;
        $current = $this->bottom;
        while($current){
            if($counter == $offset){
                $current->set($value);
                return true;
            }
            $counter++;
            $current = $current->next();
        }
        throw new \OutOfBoundsException();
    }
    abstract public function offsetUnset(  $offset );

    public function bottom(DataStructureNode $node = NULL)
    {
        if (isset($node)) {
            $this->bottom = $node;
        }
        return $this->bottom->get();
    }

    public function current()
    {
        return $this->current->get();
    }

    public function next()
    {
        $this->key++;
        $this->current = $this->current->next();
    }

    public function prev()
    {
        $this->key--;
        $this->current = $this->current->prev();
    }

    public function rewind()
    {
        $this->key = 0;
        $this->current = $this->bottom;
    }

    public function count()
    {
        if ($this->count == NULL) {
            $this->rewind();
            $count = 0;
            while ($this->current) {
                $count ++;
                $current = $current->next;
            }
            $this->count = $count;
        } else {
            return $this->count;
        }
    }

    public function listAll(DataStructureNode $node = NULL)
    {
        $listArray = [];
        if ($node == NULL) {
            $node = $this->bottom;
        }
        if (! $this->isEmpty()) {
            while ($node) {
                array_push($listArray, $node->get());
                $node = $node->next();
            }
        }
        return $listArray;
    }

    abstract public function push($value);

    public function key()
    {
        return $this->key;
    }

    abstract public function pop();

    /**
    * Add to beginning.
    * Reverse of push();
    */
    abstract public function add($value);

    abstract public function insertAfter($key, $value);

    abstract public function insertBefore($key, $value);

    /**
    * Delete from beginning.
    * Reverse of pop();
    */
    abstract public function delete();

    public function isEmpty()
    {
        if ($this->bottom == NULL) {
            return true;
        } else {
            return false;
        }
    }
}
