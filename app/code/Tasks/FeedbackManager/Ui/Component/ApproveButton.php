<?php

namespace Tasks\FeedbackManager\Ui\Component;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class ApproveButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        $status = $this->getStatus();
        if ($status || $status === null || !$status)
            $data = [
                'label' => __('Approve'),
                'class' => 'primary',
                'id' => 'feedback-approve-button',
                'data_attribute' => [
                    'url' => $this->getApproveUrl()
                ],
                'on_click' => sprintf("location.href = '%s';", $this->getApproveUrl()),
                'sort_order' => 10,
            ];

        return $data;
    }

    /**
     * @return string
     */
    public function getApproveUrl()
    {
        return $this->getUrl('*/*/approve', ['id' => $this->getId()]);
    }

}