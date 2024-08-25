<?php

namespace MoySklad\Entities\Misc;

use MoySklad\Entities\AbstractEntity;

class Webhookstock extends AbstractEntity {

    const
        STOCK_TYPE = 'stock',
        REPORT_TYPE_ALL = 'all',
        REPORT_TYPE_BYSTORE = 'bystore';

    public static $entityName = 'webhookstock';

    /**
     * @return array
     */
    public static function getFieldsRequiredForCreation()
    {
        return ['url', 'stockType', 'reportType'];
    }

    /**
     * @return AbstractEntity
     */
    public function disable(){
        $this->fields->enabled = false;
        return $this->update();
    }

    /**
     * @return AbstractEntity
     */
    public function enable(){
        $this->fields->enabled = true;
        return $this->update();
    }
}
