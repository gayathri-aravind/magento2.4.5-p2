<?php
namespace Training\MyModule\Model\ResourceModel\View;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Remittance File Collection Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Training\MyModule\Model\View::class, \Training\MyModule\Model\ResourceModel\View::class);
    }
}