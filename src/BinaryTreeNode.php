<?php
namespace Mtkocak\DataStructures;

use Exception;

class BinaryTreeNode implements TreeNodeInterface
{

    private $data;

    public $left;

    public $right;

    function __construct($data)
    {
        $this->data = $data;
        $this->left = NULL;
        $this->right = NULL;
    }

    public function left(TreeNodeInterface $node = NULL)
    {
        if (isset($node)) {
            if ($this->left != NULL) {
                throw new Exception("Node Not Empty");
            } else {
                if($node==NULL){
                    
                    echo 'yarrak';
                }
                $this->left = $node;
            }
        }
        return $this->left;
    }

    public function right(TreeNodeInterface $node = NULL)
    {
        if (isset($node)) {
            if ($this->right != NULL) {
                throw new Exception("Node Not Empty");
            } else {
                $this->right = $node;
            }
        }
        return $this->right;
    }

    public function get()
    {
        return $this->data;
    }

    public function set($value)
    {
        $this->data = $value;
    }
}
