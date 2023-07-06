<?php
namespace Tasks\BlogManager\Model\ResourceModel\Comment;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    
    public function _construct()
    {
        $this->_init(
            \Tasks\BlogManager\Model\Comment::class,
            \Tasks\BlogManager\Model\ResourceModel\Comment::class
        );
        $this->_map['fields']['entity_id'] = 'main_table.entity_id';
    }
}