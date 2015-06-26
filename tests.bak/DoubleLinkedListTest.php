<?php
use Mtkocak\Algorithms\DoubleLinkedList;

class doubleLinkedListTest extends PHPUnit_Framework_TestCase
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
        $this->doubleLinkedList->add($data);
        $lastData = $this->doubleLinkedList->get();
        $this->assertTrue($data == $lastData);
    }

    public function testAddAnotherData()
    {
        $this->testAddData();
        $anotherData = $this->generateData();
        //var_dump($anotherData);
        $this->doubleLinkedList->add($anotherData);
        $lastAnotherData = $this->doubleLinkedList->get();
        //var_dump($this->doubleLinkedList->getData());
        //var_dump($this->doubleLinkedList->listAll());
        $this->assertTrue($anotherData == $lastAnotherData);
    }

    public function testListAll()
    {
        $firstData = $this->generateData();
        $secondData = $this->generateData();
        $this->doubleLinkedList->add($firstData);
        $this->doubleLinkedList->add($secondData);
        $dataArray = [
            $firstData,
            $secondData
        ];
        $this->assertTrue($this->doubleLinkedList->listAll() == $dataArray);
    }
    
    public function testGoToPosition(){
        $this->testAddAnotherData();
        $this->testAddAnotherData();
        $this->assertTrue($this->doubleLinkedList->goToPosition(3));
    }
    
    public function testGetPosition(){
        $this->testAddAnotherData();
        //var_dump($this->doubleLinkedList->listAll());
        $dataToCheck = $this->doubleLinkedList->get();
        //var_dump($dataToCheck);
        $this->testAddAnotherData();
        $this->assertEquals($this->doubleLinkedList->getPosition(1),$dataToCheck);
    }
    
    public function testGetFirstPosition(){
        $this->testAddData();
        $dataToCheck = $this->doubleLinkedList->get();
        $this->testAddAnotherData();
        $this->assertEquals($this->doubleLinkedList->getPosition(0),$dataToCheck);
    }
    
    public function testGetLastPosition(){
        $this->testAddAnotherData();
        $this->testAddAnotherData();
        $dataToCheck = $this->doubleLinkedList->get();
        $this->assertEquals($this->doubleLinkedList->getPosition(3),$dataToCheck);
    }
    
    public function testGetEmptyPosition(){
        $this->assertEquals($this->doubleLinkedList->getPosition(1),NULL);
    }
    
    public function testSearchEmpty(){
        $dataToSearch = $this->generateData();
        $this->assertEquals($this->doubleLinkedList->search($dataToSearch),false);
    }
    
    public function testSearchFirst(){
        $dataToSearch = $this->generateData();
        $this->doubleLinkedList->add($dataToSearch);
        $this->assertEquals($this->doubleLinkedList->search($dataToSearch),0);
    }
    
    public function testSearchLast(){
        $this->testAddAnotherData();
        //echo $this->doubleLinkedList;
        $dataToSearch = $this->generateData();
        $this->doubleLinkedList->add($dataToSearch);
        $this->assertEquals($this->doubleLinkedList->search($dataToSearch),2);
    }
    
    public function testSearchMiddle(){
        $this->testAddData();
        $dataToSearch = $this->generateData();
        $this->doubleLinkedList->add($dataToSearch);
        $this->assertEquals($this->doubleLinkedList->search($dataToSearch),1);
    }
    
    public function testDeleteEmpty(){
        $this->assertEquals($this->doubleLinkedList->delete(3),false);
    }
    
    public function testDeleteLastPosition(){
        $this->testAddAnotherData();
        $dataToSearch = $this->generateData();
        $this->doubleLinkedList->add($dataToSearch);
        $this->assertEquals($this->doubleLinkedList->delete(2),true);
    }
    
    public function testDeleteLast(){
        $this->testAddData();
        $this->testAddAnotherData();
        $this->assertEquals($this->doubleLinkedList->delete(),true);
    }
    
    public function testDeleteMiddle(){
        $this->testAddData();
        $this->testAddAnotherData();
        $this->assertEquals($this->doubleLinkedList->delete(1),true);
    }
    
    public function testSetDataEmpty(){
        $dataToSet = $this->generateData();
        $this->assertEquals($this->doubleLinkedList->set($dataToSet),false);
    }
    
    public function testSetDataLastPosition(){
        $this->testAddAnotherData();
        $dataToSet = $this->generateData();
        $this->assertEquals($this->doubleLinkedList->setPosition($dataToSet,1),true);
    }
    
    public function testSetDataLast(){
        $this->testAddData();
        $this->testAddAnotherData();
        $dataToSet = $this->generateData();
        $this->assertEquals($this->doubleLinkedList->setPosition($dataToSet),true);
    }
    
    public function testSetDataMiddle(){
        $this->testAddData();
        $this->testAddAnotherData();
        $dataToSet = $this->generateData();
        $this->assertEquals($this->doubleLinkedList->setPosition($dataToSet,1),true);
    }
}
