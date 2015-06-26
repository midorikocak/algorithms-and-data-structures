<?php
namespace Mtkocak\DataStructures;

use Exception;

abstract class BinaryTree implements TreeInterface, Traversable, Searchable
{

    private $root;

    public function root(TreeNodeInterface $node = NULL)
    {
        if (isset($node)) {
            if ($this->root != NULL) {
                throw new Exception("Node Not Empty");
            } else {
                $this->root = $node;
            }
        } else {
            return $this->root;
        }
    }

    function __construct()
    {
        $this->root = NULL;
    }

    abstract public function add($value);

    abstract public function delete(TreeNodeInterface $node);

    /**
     *
     * @param DataStructureNode $node            
     * @return boolean|unknown
     */
    public function predecessor(TreeNodeInterface $node)
    {
        // Go Left and after right most element
        if ($node->left() == NULL) {
            return false;
        } else {
            $current = $node->left();
            while ($current) {
                $current = $current->right();
            }
            $address = &$current;
            return $address;
        }
    }

    public function successor(TreeNodeInterface $node)
    {
        // Go right and after left most element
        if ($node->right() == NULL) {
            return false;
        } else {
            $current = $node->right();
            while ($current) {
                $current = $current->left();
            }
            $address = &$current;
            return $address;
        }
    }

    public function isEmpty()
    {
        if ($this->root == NULL) {
            return true;
        } else {
            return false;
        }
    }

    abstract public function search($value);

    public function breadthFirst(TreeNodeInterface $node = null)
    {
        if (!isset($node)) {
            $node = $this->root();
        }
        // uses a Queue
        $queue = new Queue();
        $listArray = [];
        // first handle element and add to queue the children
        array_push($listArray, $node->readNode());
        if ($node->left() != null) {
            $queue->enqueue($node->left());
            array_push($listArray, $node->left->get());
        }
        
        if ($node->right() != null) {
            $queue->enqueue($node->right());
            array_push($listArray, $node->right->get());
        }
        while (! $queue->isEmpty()) {
            $nodeChildren = $queue->dequeue();
            array_push($listArray, $nodeChildren);
        }
        // handle queue elements and dequeue them.
        return $listArray;
    }
    
    // preorder postorder and inorder functions are using function call stack due to being recursive
    public function depthFirsth(TreeNodeInterface $node = null, $mode)
    {
        if (!isset($node)) {
            $node = $this->root();
        }
        // uses a Stack
        $listArray = [];
        $stack = new Stack();
        switch ($mode) {
            case 'postOrder':
                $current = $node;
                while (! $stack->isEmpty()) {
                    $stack->push($current);
                    if ($current->left() == null && $current->right() == null) {
                        array_push($listArray, $current->get());
                        $stack->pop();
                    } elseif ($current->left() != null) {
                        $stack->push($current->left());
                        array_push($listArray, $current->left->get());
                        $current = $current->left();
                    } elseif ($current->right != null) {
                        $stack->push($current->right());
                        array_push($listArray, $current->right->get());
                        $current = $current->right();
                    }
                    $stack->pop();
                }
                break;
            case 'inOrder':
                array_push($listArray, $node->readNode());
                while (! $stack->isEmpty()) {}
                break;
            case 'preOrder':
                while (! $stack->isEmpty()) {}
                break;
        }
        return $listArray;
    }

    public function inOrder(TreeNodeInterface $node = null)
    {
        if (!isset($node)) {
            $node = $this->root();
        }
        $listArray = [];
        if (! $this->isEmpty()) {
            if ($node->left() != null) {
                $listArray = array_merge($listArray, $this->inOrder($node->left()));
            }
            array_push($listArray, $node->get());
            if ($node->right() != null) {
                $listArray = array_merge($listArray, $this->inOrder($node->right()));
            }
        }
        // first print left, recursive
        return $listArray;
    }

    public function postOrder(TreeNodeInterface $node = null)
    
    // first print self, recursive
    {
        if (!isset($node)) {
            $node = $this->root();
        }
        $listArray = [];
        if (! $this->isEmpty()) {
            if ($node->left() != null) {
                array_push($listArray, $this->postOrder($node->left()));
            }
            if ($node->right() != null) {
                array_push($listArray, $this->postOrder($node->right()));
            }
            array_push($listArray, $node->get());
        }
        return $listArray;
    }

    public function preOrder(TreeNodeInterface $node = null)
    {
        // first print right, recursive
        if (!isset($node)) {
            $node = $this->root();
        }
        $listArray = [];
        array_push($listArray, $node->get());
        if (! $this->isEmpty()) {
            if ($node->left() != null) {
                array_push($listArray, $this->preOrder($node->left()));
            }
            if ($node->right() != null) {
                array_push($listArray, $this->preOrder($node->right()));
            }
        }
        return $listArray;
    }
}
