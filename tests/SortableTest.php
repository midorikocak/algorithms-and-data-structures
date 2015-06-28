<?php
use Mtkocak\DataStructures\DoubleLinkedList;
use Mtkocak\DataStructures\Sortable;

class SortableTest extends PHPUnit_Framework_TestCase
{

    public $doubleLinkedList;
    public $values;
    public $sortable;
    public $sorted;

    public function setup()
    {
        $this->doubleLinkedList = new DoubleLinkedList();
        $this->values = [
            8,
            6,
            5,
            9,
            7,
            1,
            12,
            2,
            10,
            4,
            11,
            3,
            13
        ];
        
        $this->sorted = [1,2,3,4,5,6,7,8,9,10,11,12,13];
        foreach($this->values as $value){
            $this->doubleLinkedList->push($value);
        }
        $this->sortable = new Sortable($this->doubleLinkedList);
    }

    public function testBucketSort()
    {
        $start = microtime();
        $this->assertEquals($this->sortable->bucketSort(),$this->sorted);
        $end = microtime();
        echo "\n"."Bucket Sort: ".($end - $start);
    }
    
    public function testBubbleSort()
    {
        $start = microtime();
        $this->sortable->bubbleSort();
        // print_r($this->doubleLinkedList->listAll());
        $this->assertEquals($this->doubleLinkedList->listAll(),$this->sorted);
        $end = microtime();
        echo "\n"."Bubble Sort: ".($end - $start);
    }
    public function testSelectionSort()
    {
        $start = microtime();
        $this->sortable->selectionSort();
        //print_r($this->doubleLinkedList->listAll());
        $this->assertEquals($this->doubleLinkedList->listAll(),$this->sorted);
        $end = microtime();
        echo "\n"."Selection Sort: ".($end - $start);
    }
    
    public function testShellSort()
    {
        $start = microtime();
        $this->sortable->shellSort();
        $this->assertEquals($this->doubleLinkedList->listAll(),$this->sorted);
        $end = microtime();
        echo "\n"."Shell Sort: ".($end - $start);
    }
    
    public function testInsertionSort()
    {
        $start = microtime();
        $this->sortable->insertionSort();
        //print_r($this->doubleLinkedList->listAll());
        $this->assertEquals($this->doubleLinkedList->listAll(),$this->sorted);
        $end = microtime();
        echo "\n"."Insertion Sort: ".($end - $start);
    }
    
    public function testInsertionSortArray()
    {
        $start = microtime();
        $this->sortable->insertionSortArray();
        //print_r($this->doubleLinkedList->listAll());
        $this->assertEquals($this->doubleLinkedList->listAll(),$this->sorted);
        $end = microtime();
        echo "\n"."Insertion Sort with Array: ".($end - $start);
    }
    
    public function testMergeSort()
    {
        $start = microtime();
        $sorted = $this->sortable->mergeSort($this->doubleLinkedList);
        $this->assertEquals($sorted->listAll(),$this->sorted);
        $end = microtime();
        echo "\n"."Merge Sort: ".($end - $start);
    }
    public function testQuickSort()
    {
        $start = microtime();
        $sorted = $this->sortable->quickSort($this->doubleLinkedList);
        //print_r($sorted->listAll());
        $this->assertEquals($sorted->listAll(),$this->sorted);
        $end = microtime();
        echo "\n"."Quick Sort: ".($end - $start);
    }
}
