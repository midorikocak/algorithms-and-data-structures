<?php
namespace Mtkocak\DataStructures;

interface TreeInterface
{

    public function root(TreeNodeInterface $node = NULL);

    public function add($value);

    public function delete(TreeNodeInterface $node);

    public function isEmpty();
}
