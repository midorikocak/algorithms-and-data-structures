<?php
use Mtkocak\Algorithms\Queue;

class QueueTest extends PHPUnit_Framework_TestCase
{

    public $queue;

    public function setup()
    {
        $this->queue = new Queue();
    }

    public function generateData()
    {
        $data = md5(microtime());
        return $data;
    }

    public function testAddData()
    {
        $data = $this->generateData();
        $this->queue->add($data);
        $lastData = $this->queue->getData();
        $this->assertTrue($data == $lastData);
    }

    public function testAddAnotherData()
    {
        $this->testAddData();
        $anotherData = $this->generateData();
        $this->queue->add($anotherData);
        $lastAnotherData = $this->queue->getData();
        
        $this->assertTrue($anotherData == $lastAnotherData);
    }

    public function testListAll()
    {
        $firstData = $this->generateData();
        $secondData = $this->generateData();
        $this->queue->add($firstData);
        $this->queue->add($secondData);
        //var_dump($this->stack->listAll());
        
        // Satck always adds to beginning
        $dataArray = [
            $secondData,
            $firstData
        ];
        //var_dump($dataArray);
        $this->assertTrue($this->queue->listAll() == $dataArray);
    }
    public function testGetData(){
        $this->testAddAnotherData();
        $this->testAddAnotherData();
        $dataToCheck = $this->queue->getData();
        $this->assertEquals($this->queue->getData(),$dataToCheck);
    }
    
    
    public function testDeleteEmpty(){
        $this->assertEquals($this->queue->delete(3),false);
    }
    
    public function testDeleteLast(){
        $this->testAddData();
        $this->testAddAnotherData();
        $this->assertEquals($this->queue->delete(),true);
    }
    
    
    public function testSetDataEmpty(){
        $dataToSet = $this->generateData();
        $this->assertEquals($this->queue->setData($dataToSet),false);
    }
    
    public function testSetDataLast(){
        $this->testAddData();
        $this->testAddAnotherData();
        $dataToSet = $this->generateData();
        $this->assertEquals($this->queue->setData($dataToSet),true);
    }
}
