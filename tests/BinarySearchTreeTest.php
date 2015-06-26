<?php
use Mtkocak\DataStructures\BinarySearchTree;

class BinarySearchTreeTest extends PHPUnit_Framework_TestCase
{

    public $binarySearchTree;
    public $values;

    public function setup()
    {
        $this->binarySearchTree = new BinarySearchTree();
        $this->values = [
            8,
            5,
            9,
            7,
            1,
            12,
            2,
            10,
            4,
            11,
            3
        ];
    }

    public function generateData()
    {
        $data = md5(microtime());
        return $data;
    }

    public function testAddDataWhenEmpty()
    {
        $this->binarySearchTree->add(1);
        $lastData = $this->binarySearchTree->root();
        $this->assertTrue($lastData->get() == 1);
    }

    public function testCreateTree()
    {
        foreach($this->values as $value){
            $this->binarySearchTree->add($value);
        }
        // Sorts!
        $this->assertTrue(sort($this->values) == $this->binarySearchTree->inOrder());
    }
    
    public function testSearchFound()
    {
        $this->testCreateTree();
        $this->assertTrue($this->binarySearchTree->search(8));
    }
    
    public function testSearchNotFound()
    {
        $this->testCreateTree();
        $this->assertFalse($this->binarySearchTree->search(36));
    }
}
