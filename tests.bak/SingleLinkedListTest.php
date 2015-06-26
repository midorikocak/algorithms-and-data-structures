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
    public function testGetPosition(){
        $this->testAddAnotherData();
        $dataToCheck = $this->singleLinkedList->getData();
        $this->testAddAnotherData();
        $this->assertEquals($this->singleLinkedList->getData(1),$dataToCheck);
    }
    
    public function testGetFirstPosition(){
        $this->testAddData();
        $dataToCheck = $this->singleLinkedList->getData();
        $this->testAddAnotherData();
        $this->assertEquals($this->singleLinkedList->getData(0),$dataToCheck);
    }
    
    public function testGetLastPosition(){
        $this->testAddAnotherData();
        $this->testAddAnotherData();
        $dataToCheck = $this->singleLinkedList->getData();
        $this->assertEquals($this->singleLinkedList->getData(3),$dataToCheck);
    }
    
    public function testGetEmptyPosition(){
        $this->assertEquals($this->singleLinkedList->getData(1),NULL);
    }
    
    public function testSearchEmpty(){
        $dataToSearch = $this->generateData();
        $this->assertEquals($this->singleLinkedList->search($dataToSearch),false);
    }
    
    public function testSearchFirst(){
        $dataToSearch = $this->generateData();
        $this->singleLinkedList->add($dataToSearch);
        $this->assertEquals($this->singleLinkedList->search($dataToSearch),0);
    }
    
    public function testSearchLast(){
        $this->testAddAnotherData();
        $dataToSearch = $this->generateData();
        $this->singleLinkedList->add($dataToSearch);
        $this->assertEquals($this->singleLinkedList->search($dataToSearch),2);
    }
    
    public function testSearchMiddle(){
        $this->testAddData();
        $dataToSearch = $this->generateData();
        $this->singleLinkedList->add($dataToSearch);
        $this->assertEquals($this->singleLinkedList->search($dataToSearch),1);
    }
    
    public function testDeleteEmpty(){
        $this->assertEquals($this->singleLinkedList->delete(3),false);
    }
    
    public function testDeleteLastPosition(){
        $this->testAddAnotherData();
        $dataToSearch = $this->generateData();
        $this->singleLinkedList->add($dataToSearch);
        $this->assertEquals($this->singleLinkedList->delete(2),true);
    }
    
    public function testDeleteLast(){
        $this->testAddData();
        $this->testAddAnotherData();
        $this->assertEquals($this->singleLinkedList->delete(),true);
    }
    
    public function testDeleteMiddle(){
        $this->testAddData();
        $this->testAddAnotherData();
        $this->assertEquals($this->singleLinkedList->delete(1),true);
    }
    
    public function testSetDataEmpty(){
        $dataToSet = $this->generateData();
        $this->assertEquals($this->singleLinkedList->setData($dataToSet),false);
    }
    
    public function testSetDataLastPosition(){
        $this->testAddAnotherData();
        $dataToSet = $this->generateData();
        $this->assertEquals($this->singleLinkedList->setData($dataToSet,1),true);
    }
    
    public function testSetDataLast(){
        $this->testAddData();
        $this->testAddAnotherData();
        $dataToSet = $this->generateData();
        $this->assertEquals($this->singleLinkedList->setData($dataToSet),true);
    }
    
    public function testSetDataMiddle(){
        $this->testAddData();
        $this->testAddAnotherData();
        $dataToSet = $this->generateData();
        $this->assertEquals($this->singleLinkedList->setData($dataToSet,1),true);
    }
}
