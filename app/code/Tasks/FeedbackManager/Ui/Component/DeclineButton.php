<?php

namespace Tasks\FeedbackManager\Ui\Component;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeclineButton extends GenericButton implements ButtonProviderInterface
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
        // Showing 'Decline' button for pending and approved statuses
        if (!$status || ($status === '1')) {
            $data = [
                'label' => __('Decline'),
                'class' => 'primary',
                'id' => 'feedback-decline-button',
                'data_attribute' => [
                    'url' => $this->getDeclineUrl()
                ],
                'on_click' => sprintf("location.href = '%s';", $this->getDeclineUrl()),
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getDeclineUrl()
    {
        return $this->getUrl('*/*/decline', ['id' => $this->getId()]);
    }
}
