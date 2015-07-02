<?php
namespace Mtkocak\DataStructures;

class Heap extends BinaryTree
{
    /*
     * (non-PHPdoc)
     * @see \Mtkocak\DataStructures\BinaryTree::add()
     */
    public function add($value)
    {
        $nodeToAttach = $this->findFirstAvaliableNode();
        $nodeToAdd = new BinaryTreeNode($value);
        
        if($nodeToAttach->left == NULL){
            $nodeToAttach->left($nodeToAdd);
        }elseif($nodeToAttach->right == NULL){
            $nodeToAttach->right($nodeToAdd);
        }
        
        // Heapify
        if($nodeToAttach->get()<$nodeToAdd->get()){
            // parent node?
        }
    }
    
    /*
     * (non-PHPdoc)
     * @see \Mtkocak\DataStructures\BinaryTree::delete()
     */
    public function delete(\Mtkocak\DataStructures\TreeNodeInterface $node)
    {
        // TODO Auto-generated method stub
    }
    
    /*
     * (non-PHPdoc)
     * @see \Mtkocak\DataStructures\BinaryTree::search()
     */
    public function search($value)
    {
        // TODO Auto-generated method stub
    }
    
    

    /**
     *
     * Similar to bredth first traversal
     *
     * @return Ambigous <NULL, TreeNodeInterface>
     */
    public function findFirstAvaliableNode()
    {
        $queue = new Queue();
        
        $queue->enqueue($this->root);
        while (! $queue->isEmpty()) {
            $dequeue = $queue->dequeue();
            if ($dequeue->left != NULL) {
                $queue->enqueue($dequeue->left);
            } else {
                return dequeue;
            }
            if ($dequeue->right != NULL) {
                $queue->enqueue($dequeue->right);
            } else {
                return dequeue;
            }
        }
    }
}
