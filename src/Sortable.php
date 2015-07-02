<?php
namespace Mtkocak\DataStructures;

class Sortable
{

    private $dataStructure;

    public function __construct(DataStructure $dataStructure)
    {
        $this->dataStructure = $dataStructure;
    }

    /**
     * If there is not a length property
     */
    public function count()
    {
        if (! method_exists($this->dataStructure, 'count')) {
            $count = 0;
            $this->dataStructure->rewind();
            if (! $this->dataStructure->isEmpty()) {
                while ($this->dataStructure->current()) {
                    $count ++;
                    $this->dataStructure->next();
                }
            }
            return $count;
        } else {
            return $this->dataStructure->count();
        }
    }

    public function reverse()
    {
        // all next should be prev
        // all prev should be next
        // top should be bottom
        // bottom should be top
    }

    /**
     * If there is not a pointer to show last element
     */
    public function findLastElement()
    {
        if (! method_exists($this->dataStructure, 'top')) {
            if (! $this->dataStructure->isEmpty()) {
                $this->dataStructure->rewind();
                while ($this->dataStructure->current()) {
                    if ($this->dataStructure->current()->next() == NULL) {
                        return $this->dataStructure->current()->get();
                    }
                    $this->dataStructure->next();
                }
            } else {
                return $dataStructure->bottom();
            }
        } else {
            return $dataStructure->top();
        }
        return false;
    }

    public function isSorted()
    {}

    public function isUnique()
    {
        $values = [];
        if (! $this->dataStructure->isEmpty()) {
            $this->dataStructure->rewind();
            while ($this->dataStructure->current()) {
                $value = $this->dataStructure->current()->get();
                if (! isset($value[$value])) {
                    $values[$value] = 1;
                } else {
                    return false;
                }
                $this->dataStructure->next();
            }
        }
    }

    public function bucketSort()
    {
        $count = $this->dataStructure->count();
        $bucket = [];
        for ($i = 1; $i <= $count; $i ++) {
            $bucket[$i] = 0;
        }
        
        $current = $this->dataStructure->bottom;
        while ($current) {
            $bucket[$current->get()] ++;
            $current = $current->next();
        }
        return array_keys($bucket);
    }

    public function quick3Sort(DataStructure $dataStructure)
    {}

    public function quickSort(DataStructure $dataStructure)
    {
        if ($dataStructure->isEmpty()) {
            return $dataStructure;
        }
        $listToReturn = new DoubleLinkedList();
        
        $smallerList = new DoubleLinkedList();
        $biggerList = new DoubleLinkedList();
        
        $current = $dataStructure->bottom;
        $pivot = $current->get();
        
        $listToReturn->add($pivot);
        
        while ($current) {
            if ($current->get() < $pivot) {
                $smallerList->add($current->get());
            } elseif ($current->get() > $pivot) {
                $biggerList->add($current->get());
            }
            $current = $current->next();
        }
        
        $sortedFirst = $this->quickSort($smallerList);
        
        $sortedSecond = $this->quickSort($biggerList);
        
        $listToReturn = $this->append($sortedFirst, $listToReturn);
        $listToReturn = $this->append($listToReturn, $sortedSecond);
        
        return $listToReturn;
    }

    private function split(DataStructure $dataStructure)
    {
        if ($dataStructure->count() == 1) {
            $arrayToReturn['firstPart'] = $dataStructure;
            $arrayToReturn['secondPart'] = NULL;
        }
        
        $arrayToReturn = [];
        
        $count = $dataStructure->count();
        $middle = ceil($count / 2);
        
        $arrayToReturn['firstPart'] = new DoubleLinkedList();
        $arrayToReturn['secondPart'] = new DoubleLinkedList();
        
        $current = $dataStructure->bottom;
        
        $counter = 1;
        
        while ($current) {
            $value = $current->get();
            
            if ($counter <= $middle) {
                $arrayToReturn['firstPart']->add($value);
            } else {
                $arrayToReturn['secondPart']->add($value);
            }
            
            $counter ++;
            $current = $current->next();
        }
        
        return $arrayToReturn;
    }

    private function append(DataStructure $first, DataStructure $second)
    {
        $listToReturn = new DoubleLinkedList();
        if ($first->isEmpty()) {
            $listToReturn = $second;
        } elseif ($second->isEmpty()) {
            $listToReturn = $first;
        } else {
            $second->bottom->prev($first->top);
            $first->top->next($second->bottom);
            $listToReturn->bottom = $first->bottom;
            $listToReturn->top = $second->top;
        }
        return $listToReturn;
    }

    /**
     * Merges two sorted linked lists non recursively
     */
    private function merge(DataStructure $first, DataStructure $second)
    {
        $listToReturn = new DoubleLinkedList();
        
        if ($first == NULL) {
            $listToReturn = $second;
        } elseif ($second == NULL) {
            $listToReturn = $first;
        } else {
            while (! $first->isEmpty() && ! $second->isEmpty()) {
                // echo $first->bottom()." and ".$second->bottom()."\n";
                if ($first->bottom() < $second->bottom()) {
                    $listToReturn->push($first->bottom());
                    $first->delete();
                } else {
                    $listToReturn->push($second->bottom());
                    $second->delete();
                }
            }
            while (! $first->isEmpty()) {
                $listToReturn->push($first->bottom());
                $first->delete();
            }
            while (! $second->isEmpty()) {
                $listToReturn->push($second->bottom());
                $second->delete();
            }
        }
        return $listToReturn;
    }

    /**
     * Does not change object's loaded datastructure.
     * Is a recursive function.
     */
    public function mergeSort(DataStructure $dataStructure)
    {
        if ($dataStructure->count() == 1) {
            return $dataStructure;
        }
        $array = $this->split($dataStructure);
        $first = $this->mergeSort($array['firstPart']);
        $second = $this->mergeSort($array['secondPart']);
        return $this->merge($first, $second);
    }

    public function bubbleSort()
    {
        $current = $this->dataStructure->bottom;
        while ($current) {
            $selectedToCompare = $current->next();
            while ($selectedToCompare) {
                if ($current->get() > $selectedToCompare->get()) {
                    $temp = $selectedToCompare->get();
                    // echo $current->get()." and ".$temp." swapped\n";
                    $selectedToCompare->set($current->get());
                    $current->set($temp);
                }
                $selectedToCompare = $selectedToCompare->next();
            }
            $current = $current->next();
        }
    }

    public function selectionSort()
    {
        $current = $this->dataStructure->bottom;
        while ($current) {
            $minElement = $current;
            $selectedToCompare = $current->next();
            while ($selectedToCompare) {
                if ((int) $minElement->get() > (int) $selectedToCompare->get()) {
                    $minElement = $selectedToCompare;
                }
                $selectedToCompare = $selectedToCompare->next();
            }
            $tmp = $current->get();
            $current->set($minElement->get());
            $minElement->set($tmp);
            $current = $current->next();
        }
    }

    public function shellSort()
    {
        $gaps = [
            701,
            301,
            132,
            57,
            23,
            10,
            4,
            1
        ];
        $array = $this->dataStructure;
        foreach ($gaps as $gap) {
            if ($gap < count($array)) {
                for ($k = 0; $k < $gap; $k ++) {
                    for ($i = 1 + $k; $i < count($array); $i = $i + $gap) {
                        for ($j = $i; $j >= 1; $j = $j - $gap) {
                            if ($array[$j] < $array[$j - 1]) {
                                $tmp = $array[$j];
                                $array[$j] = $array[$j - 1];
                                $array[$j - 1] = $tmp;
                            }
                        }
                    }
                }
            }
        }
    }

    public function insertionSortArray()
    {
        $array = $this->dataStructure;
        for ($i = 1; $i < count($array); $i ++) {
            for ($j = $i; $j >= 1; $j --) {
                if ($array[$j] < $array[$j - 1]) {
                    $tmp = $array[$j];
                    $array[$j] = $array[$j - 1];
                    $array[$j - 1] = $tmp;
                }
            }
        }
    }

    public function insertionSort()
    {
        $current = $this->dataStructure->bottom;
        while ($current) {
            // echo $current->get()."\n";
            $selectedToCompare = $current;
            while ($selectedToCompare) {
                if ($selectedToCompare->prev() != NULL && $selectedToCompare->get() < $selectedToCompare->prev()->get()) {
                    $tmp = $selectedToCompare->get();
                    $selectedToCompare->set($selectedToCompare->prev()
                        ->get());
                    $selectedToCompare->prev()->set($tmp);
                }
                // echo "\t".$selectedToCompare->get()."\n";
                $selectedToCompare = $selectedToCompare->prev();
            }
            $current = $current->next();
        }
    }

    public function heapSort()
    {}
}
