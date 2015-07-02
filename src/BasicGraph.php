<?php
namespace Mtkocak\DataStructures;

abstract class BasicGraph implements Graph
{
    private $vertices;
    private $edges;
    
    abstract public function addVertex(Vertex $vertex);
    
    abstract public function addEdge(Vertex $firstVertex,Vertex $secondVertex);
    
    abstract public function getVertex($id);
    
    abstract public function contains($id);
    
    abstract public function getVertices();
    
}
