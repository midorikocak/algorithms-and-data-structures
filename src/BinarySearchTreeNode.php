<?php

namespace Mtkocak\DataStructures;

class BinarySearchTreeNode extends BinaryTreeNode
{

    public function validate()
    {
        if ($this->data != NULL) {
            if ($this->left() != NULL && $this->left() > $this->get()) {
                return false;
            }
            if ($this->right() != NULL < $this->get()) {
                return false;
            }
        }
    }
}

