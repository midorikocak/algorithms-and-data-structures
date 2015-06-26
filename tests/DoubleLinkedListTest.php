<?php
use Mtkocak\DataStructures\DoubleLinkedList;

class DoubleLinkedListTest extends PHPUnit_Framework_TestCase
{

    public $doubleLinkedList;

    public function setup()
    {
        $this->doubleLinkedList = new DoubleLinkedList();
    }

    public function generateData()
    {
        $data = md5(microtime());
        return $data;
    }

    public function testAddData()
    {
        $data = $this->generateData();
        $this->doubleLinkedList->push($data);
        $lastData = $this->doubleLinkedList->pop();
        $this->assertTrue($data == $lastData);
    }

    public function testAddAnotherData()
    {
        $this->testAddData();
        $anotherData = $this->generateData();
        $this->doubleLinkedList->push($anotherData);
        $lastAnotherData = $this->doubleLinkedList->pop();
        $this->assertTrue($anotherData == $lastAnotherData);
    }

    public function testListAll()
    {
        $firstData = $this->generateData();
        $secondData = $this->generateData();
        $this->doubleLinkedList->push($firstData);
        $this->doubleLinkedList->push($secondData);
        $dataArray = [
            $firstData,
            $secondData
        ];
        $this->assertTrue($this->doubleLinkedList->listAll() == $dataArray);
    }
}
