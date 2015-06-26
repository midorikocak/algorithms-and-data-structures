<?php namespace Mtkocak\DataStructures;
use Exception;

class TreeNode implements TreeNodeInterface
{
    /* Data to hold */
    private $data;
    
    private $child;
    
    private $right;
    
    
    /* Node constructor */
    function __construct($data)
    {
        $this->data = $data;
        $this->children = NULL;
        $this->right = NULL;
    }
    
    public function get()
    {
        return $this->data;
    }
    
    public function set($value){
        $this->data = $value;
    }
    
    public function child(TreeNodeInterface $node = NULL){
        if(isset($node)){
            if ($this->child != NULL) {
                throw new Exception("Node Not Empty");
            } else {
                $this->child = $node;
            }
        }
        return $this->child;
    }
    
    public function right(TreeNodeInterface $node = NULL){
        if(isset($node)){
            if ($this->right != NULL) {
                throw new Exception("Node Not Empty");
            } else {
                $this->right = $node;
            }
        }
        return $this->right;
    }
}
