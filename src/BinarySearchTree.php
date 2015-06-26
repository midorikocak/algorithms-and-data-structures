<?php
namespace Mtkocak\DataStructures;

class BinarySearchTree extends BinaryTree
{

    public function add($value)
    {
        $newNode = new BinarySearchTreeNode($value);
        if (! $this->isEmpty()) {
            $current = $this->root();
            while ($current) {
                if ($value < $current->get()) {
                    if ($current->left() == NULL) {
                        $current->left($newNode);
                        return true;
                    } else {
                        $current = $current->left();
                    }
                } elseif ($value > $current->get()) {
                    if ($current->right() == NULL) {
                        $current->right($newNode);
                        return true;
                    } else {
                        $current = $current->right();
                    }
                } else {
                    return false;
                }
            }
        } else {
            $this->root($newNode);
            return true;
        }
        return false;
    }

    /**
     * Check if is a valid Binary Search Tree
     *
     * @return boolean
     */
    public function validate()
    {
        return false;
    }

    public function delete(TreeNodeInterface $node)
    {
        if ($node->left() == NULL && $node->right() == NULL) {
            $node = NULL;
        } elseif ($node->left() != NULL && $node->right() == NULL) {
            $node = $node->left();
        } elseif ($node->left() == NULL && $node->right() != NULL) {
            $nodeToDelete = $node;
            $node = $node->right();
            unset($nodeToDelete);
        } else {
            $predecessor = $this->predecessor($node);
            $successor = $this->successor($node);
            if ($predecessor != NULL && $predecessor != false) {
                $node = $predecessor;
            } elseif ($successor != NULL && $successor != false) {
                $node = $successor;
            }
        }
    }

    public function deleteValue($value)
    {
        $current = $this->root();
        $parent = NULL;
        $direction = NULL;
        while($current){
            if ($value < $current->get()) {
                if ($current->left() != NULL) {
                    $parent = $current;
                    $direction = 'left';
                    $current = $current->left();
                } else {
                    return false;
                }
            } elseif ($value > $current->get()) {
                if ($current->right() != NULL) {
                    $parent = $current;
                    $direction = 'right';
                    $current = $current->right();
                } else {
                    return false;
                }
            } else {
                if($current->left()==NULL && $current->right()==NULL){
                    if($direction=='right'){
                        $parent->right = NULL;
                    }
                    if($direction=='left'){
                        $parent->left = NULL;
                    }
                }elseif($current->left()!=NULL && $current->right()==NULL){
                    if($direction=='right'){
                        $parent->right = $current->left();
                    }
                    if($direction=='left'){
                        $parent->left = $current->left();
                    }
                }elseif($current->left()==NULL && $current->right()!=NULL){
                    if($direction=='right'){
                        $parent->right = $current->right();
                    }
                    if($direction=='left'){
                        $parent->left = $current->right();
                    }
                }
                elseif($current->left()!=NULL && $current->right()!=NULL){
                    if($direction=='right'){
                        $parent->right = $current->right();
                    }
                    if($direction=='left'){
                        $parent->left = $current->left();
                    }
                    
                    $predecessor = $this->predecessor($current);
                    $successor = $this->successor($current);
                    if ($predecessor != NULL && $predecessor != false) {
                        $current = $predecessor;
                    } elseif ($successor != NULL && $successor != false) {
                        $current = $successor;
                    }
                    
                }
                return true;
            }  
        }
        return false;
    }

    public function search($value)
    {
        $current = $this->root();
        while ($current) {
            if ($value < $current->get()) {
                if ($current->left() != NULL) {
                    $current = $current->left();
                } else {
                    return false;
                }
            } elseif ($value > $current->get()) {
                if ($current->right() != NULL) {
                    $current = $current->right();
                } else {
                    return false;
                }
            } else {
                return true;
            }
        }
        return false;
    }
}
