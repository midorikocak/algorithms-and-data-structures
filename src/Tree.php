<?php
namespace Mtkocak\Algorithms;

class Tree implements DataStructureInterface
{

    public $root;

    function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->root = NULL;
    }

    /**
     * A position should like 1.2 and parsed
     *
     * @see \Mtkocak\Algorithms\DataStructureInterface::add()
     */
    public function add($value, $position = null)
    {
        $newNode = new TreeNode($value);
        // if this is empty, add value as root
        if ($this->isEmpty()) {
            $this->root = $newNode;
        } // if this is not empty and no position add children to root
elseif (! isset($position)) {
            if ($this->root->children == NULL) {
                $this->root->children = $newNode;
                return true;
            } else {
                $nodeToAdd = $this->goToLastSibling($this->root->children);
                $nodeToAdd->right = $newNode;
                return true;
            }
        } else {
            $nodeToAddChildren = $this->getNodeByPosition($position);
            if ($nodeToAddChildren->children == NULL) {
                $nodeToAddChildren->children = $newNode;
                return true;
            } else {
                $nodeToAddSibling = $this->goToLastSibling($nodeToAddChildren);
                $nodeToAddSibling->right = $newNode;
                return true;
            }
        }
        // if there is position go to position like 1.1 then add value
        return false;
    }

    public function getNodeByPosition($position = null)
    {
        $current = $this->root;
        if ($position == 0) {
            return $current;
        }
        if (isset($position) && preg_match('/^[0-9](\.[0-9])*?$/', $position)) {
            $positionArray = explode('.', $position);
            foreach ($positionArray as $positions) {
                $current = $current->children;
                for ($i = 1; $i < $positions; $i ++) {
                    $current = $current->right;
                }
            }
            return $current;
        }
        return false;
    }

    public function goToLastSibling(TreeNode $node)
    {
        while ($node->right) {
            $node = $node->right;
        }
        return $node;
    }

    public function goToLastChild(TreeNode $node)
    {
        while ($node->children) {
            $node = $node->children;
        }
        return $node;
    }

    public function goToLastNumberedSibling(TreeNode $node, $number)
    {
        $counter = 1;
        while ($node->right && $counter < $number) {
            $node = $node->right;
            $counter ++;
        }
        return $node;
    }

    public function goToLastNumberedChild(TreeNode $node, $number)
    {
        $node = $node->children;
        $counter = 1;
        while ($node->children && $counter < $number) {
            $node = $node->children;
            $counter ++;
        }
        return $node;
    }

    public function getData($position = null)
    {
        if (! $this->isEmpty() && ! isset($position)) {
            return $this->root->readNode();
        }
        if (! $this->isEmpty() && isset($position)) {
            $nodeToGetData = $this->getNodeByPosition($position);
            if ($nodeToGetData != NULL) {
                return $nodeToGetData->readNode();
            }
        }
        return false;
    }

    public function isEmpty()
    {
        if ($this->root == NULL) {
            return true;
        } else {
            return false;
        }
    }

    public function traverse(TreeNode $subtree, $degree = null)
    {
        // if 0 is root. else get position and increase when going right
        
        // go to first child array[0][1]['value']
        
        // are there other children? go to right array[0][2] array[0][3] ...
        
        // go recursively each node's children if they have children.
        
        // array[0][1][1]['value'] => '1.1';
        
        // a children counter when going right array[1] array[2] ... and append to parent using recursion
        
        $array = [];
        $current = $subtree;
        if(isset($degree) && $degree == 0)
        {
            $siblings = 0;
        }else{
            $siblings = 1;
        }
        while ($current) {
            if ($current->children != null) {
                $array[$siblings] = $this->traverse($current->children);
            }
            $array[$siblings]['value'] = $current->readNode();
            $siblings++;
            $current = $current->right;
        }
        return $array;
    }

    /**
     * We should traverse the ordinary node.
     * We should use recursive method.
     * Because we do not know where tree terminates.
     * Still problematic because does not generate correct array indexes.
     *
     * @see \Mtkocak\Algorithms\DataStructureInterface::listAll()
     */
    public function listAll()
    {
        return $this->traverse($this->root, 0);
    }

    public function delete($position = null)
    {
        if (! $this->isEmpty() && isset($position)) {
            $nodeToDelete = $this->getNodeByPosition($position);
            if ($nodeToDelete != NULL) {
                unset($nodeToDelete);
                return true;
            }
        }
        return false;
    }

    public function setData($value, $position = null)
    {
        if (! $this->isEmpty() && ! isset($position)) {
            return $this->root->readNode();
        }
        if (! $this->isEmpty() && isset($position)) {
            $nodeToSetData = $this->getNodeByPosition($position);
            if ($nodeToSetData != NULL) {
                $nodeToSetData->data = $value;
                return true;
            }
        }
        return false;
    }

    
    /**
     * TODO: need to update with new traverse function
     * @see \Mtkocak\Algorithms\DataStructureInterface::search()
     */
    public function search($value)
    {
        return true;
    }
}
