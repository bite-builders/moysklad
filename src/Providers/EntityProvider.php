<?php

namespace MoySklad\Providers;

use MoySklad\Entities\AbstractEntity;
use MoySklad\Entities\Assortment;
use MoySklad\Entities\Counterparty;
use MoySklad\Entities\Orders\AbstractOrder;
use MoySklad\Entities\Orders\CustomerOrder;
use MoySklad\Entities\Orders\PurchaseOrder;
use MoySklad\Entities\Organization;
use MoySklad\Entities\Products\AbstractProduct;
use MoySklad\Entities\Products\Product;
use MoySklad\Entities\Products\Service;
use MoySklad\Utils\AbstractSingleton;

class EntityProvider extends AbstractSingleton{
    protected static $instance = null;
    public $entities = [
        AbstractEntity::class,
        AbstractOrder::class,
        CustomerOrder::class,
        PurchaseOrder::class,
        Assortment::class,
        Counterparty::class,
        Organization::class,
        AbstractProduct::class,
        Product::class,
        Service::class
    ];
    public $entityNames = [];

    protected function __construct()
    {
        foreach ($this->entities as $i=>$e){
            $this->entityNames[$e::$entityName] = $e;
        }
    }
}