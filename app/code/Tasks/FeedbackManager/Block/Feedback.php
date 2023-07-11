<?php
namespace Tasks\FeedbackManager\Block;

class Feedback extends \Magento\Framework\View\Element\Template
{
    protected $feedbackFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Tasks\FeedbackManager\Model\FeedbackFactory $feedbackFactory,
        array $data = []
    ) {
        $this->feedbackFactory = $feedbackFactory;
        parent::__construct($context, $data);
    }

    public function getFeedback()
    {
        $feedbackId = $this->getRequest()->getParam('id');
        return $this->feedbackFactory->create()->load($feedbackId);
    }
}