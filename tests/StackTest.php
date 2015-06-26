<?php
use Mtkocak\DataStructures\Stack;

class StackTest extends PHPUnit_Framework_TestCase
{

    public $stack;

    public function setup()
    {
        $this->stack = new Stack();
    }

    public function generateData()
    {
        $data = md5(microtime());
        return $data;
    }

    public function testAddData()
    {
        $data = $this->generateData();
        $this->stack->push($data);
        $lastData = $this->stack->pop();
        $this->assertTrue($data == $lastData);
    }

    public function testAddAnotherData()
    {
        $this->testAddData();
        $anotherData = $this->generateData();
        $this->stack->push($anotherData);
        $lastAnotherData = $this->stack->pop();
        $this->assertTrue($anotherData == $lastAnotherData);
    }
}
