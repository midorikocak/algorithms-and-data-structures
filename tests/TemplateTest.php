<?php
 
use Mtkocak\Template\Template;
 
class TemplateTest extends PHPUnit_Framework_TestCase {
 
  public function testTemplateHasCheese()
  {
    $template = new Template;
    $this->assertTrue($template->hasCheese());
  }
 
}