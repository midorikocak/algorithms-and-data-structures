<?php

namespace Mtkocak\DataStructures;

interface DataStructure
{
    
    public function bottom();
    
    public function add($value);
    
    public function delete();
    
    public function isEmpty();
   
}
