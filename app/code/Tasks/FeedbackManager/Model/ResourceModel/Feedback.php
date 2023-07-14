<?php

namespace Tasks\FeedbackManager\Model\ResourceModel;

class Feedback extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function _construct()
    {
        $this->_init("feedbackmanager_feedback", "entity_id");
    }
}
