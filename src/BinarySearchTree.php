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
            $nodeToDelete = $node;
            $node = NULL;
            unset($nodeToDelete);
        } elseif ($node->left() != NULL && $node->right() == NULL) {
            $nodeToDelete = $node;
            $node = $node->left();
            unset($nodeToDelete);
        } elseif ($node->left() == NULL && $node->right() != NULL) {
            $nodeToDelete = $node;
            $node = $node->right();
            unset($nodeToDelete);
        } else {
            $predecessor = $this->predecessor($node);
            $successor = $this->successor($node);
            if ($predecessor != NULL && $predecessor != false) {
                $node = clone $predecessor;
                unset($predecessor);
            } elseif ($successor != NULL && $successor != false) {
                $node = clone $successor;
                unset($successor);
            }
        }
    }

    public function deleteValue($value)
    {
        $node = $this->search($value);
        if ($node) {
            $this->delete($node);
            return true;
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
