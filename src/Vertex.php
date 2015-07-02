<?php
namespace Mtkocak\DataStructures;

interface Vertex
{

    public function addEdge(Vertex $vertex);

    public function getEdges();

    public function get();

    public function set($value);

    public function getUniqueId();
}
