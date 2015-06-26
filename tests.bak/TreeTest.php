<?php
use Mtkocak\Algorithms\Tree;
use Mtkocak\Algorithms\TreeNode;

class TreeTest extends PHPUnit_Framework_TestCase
{

    public $tree;
    public $treeArray;

    public function setup()
    {
        $this->tree = new Tree();
        
        // root
        $rootValue = $this->generateData();
        $this->tree->root = new TreeNode($rootValue);
        
        // filling treee with data
        $this->tree->root->children = new TreeNode('1');
        $this->tree->root->children->right = new TreeNode('2');
        $thirdValue = $this->generateData();
        $this->tree->root->children->right->right = new TreeNode($thirdValue);
        $this->tree->root->children->right->right->right = new TreeNode('4');
        $this->tree->root->children->children = new TreeNode('1.1');
        $this->tree->root->children->children->children = new TreeNode('1.1.1');
        $this->tree->root->children->children->right = new TreeNode('1.2');
        $this->tree->root->children->children->right->children = new TreeNode('1.2.1');
        
        $this->treeArray = [
            0 => [
                'value' => $rootValue,
                1 => [
                    'value' => '1',
                    1 => [
                        'value' => '1.1',
                        1 => [
                            'value' => '1.1.1'
                        ]
                    ],
                    2 => [
                        'value' => '1.2',
                        1 => [
                            'value' => '1.2.1'
                        ]
                    ]
                ],
                2 => [
                    'value' => '2'
                ],
                3 => [
                    'value' => $thirdValue
                ],
                4 => [
                    'value' => '4'
                ]
            ]
        ];
    }

    public function generateData()
    {
        $data = md5(microtime());
        return $data;
    }

    public function testGoToLastSibling()
    {
        $lastSiblingToCheck = $this->tree->goToLastSibling($this->tree->root->children);
        $this->assertTrue($lastSiblingToCheck->readNode() == 4);
    }

    public function testGoToLastNumberedSibling()
    {
        $lastNumberedSiblingToCheckValue = $this->tree->root->children->right->right->readNode();
        $lastNumberedSiblingToCheck = $this->tree->goToLastNumberedSibling($this->tree->root->children, 3);
        $this->assertTrue($lastNumberedSiblingToCheck->readNode() == $lastNumberedSiblingToCheckValue);
    }

    public function testGoToLastChild()
    {
        $lastChildrenToCheck = $this->tree->goToLastChild($this->tree->root);
        $this->assertTrue($lastChildrenToCheck->readNode() == '1.1.1');
    }

    public function testGoToLastNumberedChild()
    {
        $lastChildrenToCheck = $this->tree->goToLastNumberedChild($this->tree->root, 3);
        $this->assertTrue($lastChildrenToCheck->readNode() == '1.1.1');
    }

    public function testGetNodeByPositionZero()
    {
        $node = $this->tree->getNodeByPosition('1.2.1');
        
        $this->assertTrue('1.2.1' == $node->readNode());
    }

    public function testAddData()
    {
        $data = $this->generateData();
        $this->tree->add($data);
        $lastData = $this->tree->goToLastSibling($this->tree->root->children);
        $this->assertTrue($data == $lastData->readNode());
    }

    public function testAddChildren()
    {
        $this->testAddData();
        $anotherData = $this->generateData();
        $this->tree->add($anotherData, '1');
        $lastData = $this->tree->goToLastSibling($this->tree->root->children);
        
        $this->assertTrue($anotherData == $lastData->readNode());
    }

    public function testListAll()
    {
        $this->assertTrue($this->treeArray == $this->tree->listAll());
        // print_r($this->tree);
    }

    public function testSearch()
    {
        $dataToSearch = $this->generateData();
        $this->tree->add($dataToSearch);
        $this->assertEquals($this->tree->search($dataToSearch), true);
    }

    public function testDelete()
    {
        $this->assertEquals($this->tree->delete(3), true);
    }

    public function testSetDataEmpty()
    {
        $this->assertEquals($this->tree->setData('new value', '3'), true);
    }
}
