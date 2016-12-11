<?php

namespace MoySklad\Lists;

use MoySklad\Components\MassRequest;
use MoySklad\Entities\AbstractEntity;
use MoySklad\MoySklad;
use MoySklad\Providers\EntityProvider;

class EntityList implements \JsonSerializable{
    private
        $skladInstance,
        $items = [];

    public function __construct(MoySklad $skladInstance, $items)
    {
        $this->skladInstance = $skladInstance;
        if ( $items instanceof EntityList ){
            $this->items = $items->toArray();
        } else {
            $this->items = $items;
        }
    }

    public function each(callable $cb){
        $this->getIterator()->each($cb);
        return $this;
    }

    public function transformItemsToClass($targetClass){
        $this->items = array_map(function(AbstractEntity $e) use($targetClass){
            return $e->transformToClass($targetClass);
        }, $this->items);
        return $this;
    }

    public function transformItemsToMetaClass(){
        $this->items = array_map(function(AbstractEntity $e){
            return $e->transformToMetaClass();
        }, $this->items);
        return $this;
    }

    public function massCreate(){
        $mr = new MassRequest($this->skladInstance, $this->items);
        $this->items = $mr->create();
        return $this;
    }

    public function getIterator(){
        return new ListIterator($this->items);
    }

    public function push(AbstractEntity $entity){
        $this->items[] = $entity;
    }

    public function count(){
        return count($this->items);
    }

    public function toArray(){
        return $this->items;
    }

    function jsonSerialize()
    {
        return $this->toArray();
    }
}