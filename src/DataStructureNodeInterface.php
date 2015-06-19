<?php

namespace Mtkocak\Algorithms;

/**
 * A node is the object that holds data.
 * 
 * @author mtkocak
 * @see http://www.codediesel.com/php/linked-list-in-php/
 *
 */
interface DataStructureNodeInterface
{

    /**
     * Returns data held in node.
     *
     * We consider data as strings, but hence php is not strongly typed, we can 
     * reuse this data as integer or etc.
     *
     * @return string
     */
    public function readNode();
}
