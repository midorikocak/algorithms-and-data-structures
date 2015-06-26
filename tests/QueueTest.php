<?php
use Mtkocak\DataStructures\Queue;

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
        $this->queue->enqueue($data);
        $lastData = $this->queue->dequeue();
        $this->assertTrue($data == $lastData);
    }

    public function testAddAnotherData()
    {
        $this->testAddData();
        $anotherData = $this->generateData();
        $this->queue->enqueue($anotherData);
        $lastAnotherData = $this->queue->dequeue();
        $this->assertTrue($anotherData == $lastAnotherData);
    }
}
