<?php
namespace Tasks\FeedbackManager\Controller\Adminhtml\Manage;

use Magento\Framework\Controller\ResultFactory;

class MassDelete extends \Magento\Backend\App\Action
{
    protected $collectionFactory;

    protected $filter;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Tasks\FeedbackManager\Model\ResourceModel\Feedback\CollectionFactory $collectionFactory
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());

            $count = 0;
            foreach ($collection as $model) {
                $model->delete();
                $count++;
            }
            $this->messageManager->addSuccess(__('A total of %1 feedback(s) have been deleted.', $count));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }

    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Tasks_FeedbackManager::delete');
    }
}