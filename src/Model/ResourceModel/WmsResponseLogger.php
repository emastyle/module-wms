<?php

declare(strict_types=1);

namespace Gian\Wms\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Gian\Wms\Api\Data\WmsResponseLoggerDataInterface;

class WmsResponseLogger extends AbstractDb
{
    protected function _construct(): void
    {
        $this->_init('gian_wms_response_logger', WmsResponseLoggerDataInterface::ID);
    }
}
