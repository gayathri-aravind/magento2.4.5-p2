<?php

namespace Training\MyModule\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class View extends AbstractDb
{
    /**
     * Post Abstract Resource Constructor
     * @return void
     */
    protected function _construct()
    {
        // $this->_init('table name', 'primary key of that table');
        $this->_init('training_mymodule_article', 'article_id');
    }
}