<?php namespace Mtkocak\DataStructures;

interface DataStructureIterator
{
    
    public function current();
    
    public function next();
    
    public function rewind();
    
    public function key();

}
