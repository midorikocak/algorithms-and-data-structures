<?php
use Mtkocak\Algorithms\Stack;

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
        $this->stack->add($data);
        $lastData = $this->stack->getData();
        $this->assertTrue($data == $lastData);
    }

    public function testAddAnotherData()
    {
        $this->testAddData();
        $anotherData = $this->generateData();
        $this->stack->add($anotherData);
        $lastAnotherData = $this->stack->getData();
        
        $this->assertTrue($anotherData == $lastAnotherData);
    }

    public function testListAll()
    {
        $firstData = $this->generateData();
        $secondData = $this->generateData();
        $this->stack->add($firstData);
        $this->stack->add($secondData);
        //var_dump($this->stack->listAll());
        
        // Satck always adds to beginning
        $dataArray = [
            $secondData,
            $firstData
        ];
        
        //var_dump($dataArray);
        $this->assertTrue($this->stack->listAll() == $dataArray);
    }
    public function testGetPosition(){
        $this->testAddAnotherData();
        $dataToCheck = $this->stack->getData();
        $this->testAddAnotherData();
        $this->assertEquals($this->stack->getData(2),$dataToCheck);
    }
    
    public function testGetFirstPosition(){
        $this->testAddData();
        $this->testAddAnotherData();
        $dataToCheck = $this->stack->getData();
        $this->assertEquals($this->stack->getData(0),$dataToCheck);
    }
    
    public function testGetLastPosition(){
        $this->testAddAnotherData();
        $this->testAddAnotherData();
        $dataToCheck = $this->stack->getData();
        $this->assertEquals($this->stack->getData(0),$dataToCheck);
    }
    
    public function testGetEmptyPosition(){
        $this->assertEquals($this->stack->getData(1),NULL);
    }
    
    public function testSearchEmpty(){
        $dataToSearch = $this->generateData();
        $this->assertEquals($this->stack->search($dataToSearch),false);
    }
    
    public function testSearchFirst(){
        $dataToSearch = $this->generateData();
        $this->stack->add($dataToSearch);
        $this->assertEquals($this->stack->search($dataToSearch),0);
    }
    
    public function testSearchLast(){
        $this->testAddAnotherData();
        $dataToSearch = $this->generateData();
        $this->stack->add($dataToSearch);
        // Last added element is always first elemen in stack LIFO
        // Last in first out.
        $this->assertEquals($this->stack->search($dataToSearch),0);
    }
    
    public function testSearchMiddle(){
        $this->testAddData();
        $dataToSearch = $this->generateData();
        $this->stack->add($dataToSearch);
        $this->testAddData();
        $this->assertEquals($this->stack->search($dataToSearch),1);
    }
    
    public function testDeleteEmpty(){
        $this->assertEquals($this->stack->delete(3),false);
    }
    
    public function testDeleteLastPosition(){
        $this->testAddAnotherData();
        $dataToSearch = $this->generateData();
        $this->stack->add($dataToSearch);
        $this->assertEquals($this->stack->delete(2),true);
    }
    
    public function testDeleteLast(){
        $this->testAddData();
        $this->testAddAnotherData();
        $this->assertEquals($this->stack->delete(),true);
    }
    
    public function testDeleteMiddle(){
        $this->testAddData();
        $this->testAddAnotherData();
        $this->assertEquals($this->stack->delete(1),true);
    }
    
    public function testSetDataEmpty(){
        $dataToSet = $this->generateData();
        $this->assertEquals($this->stack->setData($dataToSet),false);
    }
    
    public function testSetDataLastPosition(){
        $this->testAddAnotherData();
        $dataToSet = $this->generateData();
        $this->assertEquals($this->stack->setData($dataToSet,1),true);
    }
    
    public function testSetDataLast(){
        $this->testAddData();
        $this->testAddAnotherData();
        $dataToSet = $this->generateData();
        $this->assertEquals($this->stack->setData($dataToSet),true);
    }
    
    public function testSetDataMiddle(){
        $this->testAddData();
        $this->testAddAnotherData();
        $dataToSet = $this->generateData();
        $this->assertEquals($this->stack->setData($dataToSet,1),true);
    }
}
