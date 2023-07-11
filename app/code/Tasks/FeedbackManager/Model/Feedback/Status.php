<?php
namespace Tasks\FeedbackManager\Model\Feedback;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    public function toOptionArray()
    {
        $options = [];
        $options[] = ['label' => 'Pending', 'value' => 0];
        $options[] = ['label' => 'Approved', 'value' => 1];
        $options[] = ['label' => 'Declined', 'value' => 2];
        return $options;
    }
}