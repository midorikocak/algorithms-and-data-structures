<?php
namespace Mtkocak\DataStructures;

interface Traversable
{

    public function postOrder(TreeNodeInterface $node = null);

    public function inOrder(TreeNodeInterface $node = null);

    public function preOrder(TreeNodeInterface $node = null);

    public function breadthFirst(TreeNodeInterface $node = null);

    public function depthFirsth(TreeNodeInterface $node = null, $mode);
}
