<?php
namespace Tasks\FeedbackManager\Block\Adminhtml;

class FeedbackView extends \Magento\Framework\View\Element\Template
{
    protected $feedbackCollection;

    protected $request;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Tasks\FeedbackManager\Model\ResourceModel\Feedback\CollectionFactory $feedbackCollection,
        array $data = []
    ) {
        $this->feedbackCollection = $feedbackCollection;
        $this->request = $request;
        parent::__construct($context, $data);
    }

    public function getDataById()
    {
        $entityId = $this->request->getParam('id');

        $collection = $this->feedbackCollection->create();
        $collection->addFieldToFilter('entity_id', ['eq'=>$entityId]);

        return $collection;
    }
}