<?php
use Mtkocak\DataStructures\SingleLinkedList;

class SingleLinkedListTest extends PHPUnit_Framework_TestCase
{

    public $singleLinkedList;

    public function setup()
    {
        $this->singleLinkedList = new SingleLinkedList();
    }

    public function generateData()
    {
        $data = md5(microtime());
        return $data;
    }

    public function testAddData()
    {
        $data = $this->generateData();
        $this->singleLinkedList->push($data);
        $lastData = $this->singleLinkedList->pop();
        $this->assertTrue($data == $lastData);
    }

    public function testAddAnotherData()
    {
        $this->testAddData();
        $anotherData = $this->generateData();
        $this->singleLinkedList->push($anotherData);
        $lastAnotherData = $this->singleLinkedList->pop();
        $this->assertTrue($anotherData == $lastAnotherData);
    }

    public function testListAll()
    {
        $firstData = $this->generateData();
        $secondData = $this->generateData();
        $this->singleLinkedList->push($firstData);
        $this->singleLinkedList->push($secondData);
        $dataArray = [
            $firstData,
            $secondData
        ];
        $this->assertTrue($this->singleLinkedList->listAll() == $dataArray);
    }
}
