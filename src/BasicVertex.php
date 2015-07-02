<?php
namespace Mtkocak\DataStructures;

abstract class BasicVertex implements Vertex
{
    public $data;
    
    function __construct(Graph $graph){
        
    }

    abstract public function addEdge(Vertex $vertex);

    abstract public function getEdges();

    abstract public function get();

    abstract public function set($value);

    abstract public function getUniqueId();
}
