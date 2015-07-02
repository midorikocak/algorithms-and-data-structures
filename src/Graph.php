<?php
namespace Mtkocak\DataStructures;

interface Graph
{
    public function addVertex(Vertex $vertex);
    
    public function getVertex($id);
    
    private function contains($id);
    
    public function getVertices();
    
}
