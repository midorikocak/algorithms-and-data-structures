<?php
namespace Mtkocak\Algorithms;

class Stack
{

    /**
     * A stack pointer always shows the beginning of the list.
     * All operations are made here.
     *
     * @var SingleLinkedListNode
     */
    public $pointer;

    function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->pointer = NULL;
    }

    public function isEmpty()
    {
        if ($this->pointer == NULL) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * We can use single linked list node.
     *
     * @param unknown $value            
     */
    public function add($value)
    {
        $newNode = new SingleLinkedListNode($value);
        if ($this->isEmpty()) {
            $this->pointer = $newNode;
        } else {
            $oldStartNode = $this->pointer;
            $newNode->next = $oldStartNode;
            
            // Added to beginning
            $this->pointer = $newNode;
        }
    }

    public function listAll()
    {
        $listData = [];
        if (! $this->isEmpty()) {
            $current = $this->pointer;
            // goes until null
            while ($current) {
                array_push($listData, $current->readNode());
                $current = $current->next;
            }
        }
        return $listData;
    }

    /**
     * Similar to listAll function
     *
     * @param unknown $value            
     */
    public function search($value)
    {
        if (! $this->isEmpty()) {
            $position = 0;
            $current = $this->pointer;
            // goes until null
            while ($current) {
                if ($current->readNode() == $value) {
                    return $position;
                }
                $current = $current->next;
                $position ++;
            }
        }
        return false;
    }

    public function delete($position = NULL)
    {
        $currentPosition = 0;
        $currentNode = $this->pointer;
        // Select which node to delete
        if (! $this->isEmpty() && isset($position)) {
            while ($position != $currentPosition) {
                if (($currentPosition + 1) == $position) {
                    // the next node is the node to delete
                    $nodeToDelete = $currentNode->next;
                    // we get the next of the nodeTodele and add to current node
                    $currentNode->next = $nodeToDelete->next;
                    unset($nodeToDelete);
                    return true;
                } else {
                    $currentNode = $currentNode->next;
                }
                $currentPosition ++;
            }
        } elseif (! $this->isEmpty() && ! isset($position)) {
            $nodeToDelete = $this->pointer;
            $this->pointer = $nodeToDelete->next;
            unset($nodeToDelete);
            return true;
        } else {
            return false;
        }
    }

    public function setData($value, $position = NULL)
    {
        $currentPosition = 0;
        $currentNode = $this->pointer;
        // Select which node to delete
        if (! $this->isEmpty() && isset($position)) {
            while ($position != $currentPosition) {
                if (($currentPosition + 1) == $position) {
                    // the next node is the node to change
                    $nodeToChange = $currentNode->next;
                    $nodeToChange->data = $value;
                    return true;
                } else {
                    $currentNode = $currentNode->next;
                }
                $currentPosition ++;
            }
        } elseif (! $this->isEmpty() && ! isset($position)) {
            $nodeToChange = $this->pointer;
            $nodeToChange->data = $value;
            return true;
        } else {
            return false;
        }
    }

    public function getData($position = NULL)
    {
        $currentPosition = 0;
        $currentNode = $this->pointer;
        // Select which node to delete
        if (! $this->isEmpty() && isset($position)) {
            // I don't like repeated code
            if($position==0){
                $nodeToGetValue = $this->pointer;
                return $nodeToGetValue->data;
            }
            while ($position != $currentPosition) {
                if (($currentPosition + 1) == $position) {
                    // the next node is the node to change
                    $nodeToGetValue = $currentNode->next;
                    return $nodeToGetValue->data;
                } else {
                    $currentNode = $currentNode->next;
                }
                $currentPosition ++;
            }
        } elseif (! $this->isEmpty() && ! isset($position)) {
            $nodeToGetValue = $this->pointer;
            return $nodeToGetValue->data;
        } else {
            return false;
        }
    }
}
