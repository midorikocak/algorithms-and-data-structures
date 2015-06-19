<?php

namespace Mtkocak\Algorithms;

/**
 * Data Sctructures interface aims to help to practice CS topics.
 * Hence, PHP is
 * a bit different than C like languages, strongly typed and low level memory
 * apporach, mehtods can have parameters like, position, value.
 */
interface DataStructureInterface
{

    /**
     * Starts data strcuture, creates beginning and end units, etc.
     *
     * Most of data structures need this, but i.e arrays in PHP is different
     * than C, an end should be defined if standard library not used.
     *
     * @return self
     */
    public function init();

    /**
     *
     * @param unknown $value            
     */
    public function add($value);

    /**
     */
    public function listAll();

    /**
     *
     * @param unknown $value            
     */
    public function search($value);

    /**
     *
     * @param string $position            
     */
    public function delete($position = NULL);

    /**
     *
     * @param string $position            
     * @param unknown $value            
     */
    public function setData($position = NULL, $value);

    /**
     *
     * @param string $position            
     */
    public function getData($position = NULL);
}
