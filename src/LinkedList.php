<?php
namespace Mtkocak\DataStructures;
use Exception;

abstract class LinkedList implements DataStructure, Listable, DataStructureIterator
{

    /**
     * Last Element
     */
    protected $top;

    /**
     * First Element
     */
    protected $bottom;

    /**
     * Pointer Element
     */
    protected $current;

    protected $count = NULL;

    public function __construct()
    {
        $this->top = NULL;
        $this->bottom = NULL;
        $this->current = $this->bottom;
        $this->count = $this->count();
    }

    public function top(DataStructureNode $node = NULL)
    {
        if (isset($node)) {
            $this->top = $node;
        }
        return $this->top->get();
    }

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
        $this->current = $this->current->next();
    }

    public function prev()
    {
        $this->current = $this->current->prev();
    }

    public function rewind()
    {
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
        $node = $this->current;
        $key = 0;
        $pointer = $this->bottom;
        while ($pointer != $node) {
            $key ++;
            $pointer = $pointer->next();
        }
        return $key;
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
