<?php
 
use Mtkocak\Algorithms\Algorithms;
 
class AlgorithmsTest extends PHPUnit_Framework_TestCase
{
    public function testAlgorithmsHasCheese()
    {
        //print_r(get_declared_classes());
        $algorithms = new Algorithms;
        $this->assertTrue($algorithms->hasCheese());
    }
}
