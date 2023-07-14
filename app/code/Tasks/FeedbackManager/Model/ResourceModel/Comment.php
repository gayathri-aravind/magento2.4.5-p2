<?php

namespace Tasks\FeedbackManager\Model\ResourceModel;

class Comment extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init("feedbackmanager_comment", "entity_id");
    }
}
