<?php
namespace Tasks\FeedbackManager\Model\ResourceModel\Feedback;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    
    public function _construct()
    {
        $this->_init(
            \Tasks\FeedbackManager\Model\Feedback::class,
            \Tasks\FeedbackManager\Model\ResourceModel\Feedback::class
        );
        $this->_map['fields']['entity_id'] = 'main_table.entity_id';
    }
}