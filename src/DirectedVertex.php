<?php
namespace Mtkocak\DataStructures;

interface Vertex
{

    public function addEdge(Vertex $vertex);

    public function getEdge();

    public function get();

    public function set($value);

    public function getUniqueId();
}
