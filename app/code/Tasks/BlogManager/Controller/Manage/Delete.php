<?php
namespace Tasks\BlogManager\Controller\Manage;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;

class Delete extends AbstractAccount
{
    protected $blogFactory;
    protected $customerSession;
    protected $messageManager;

    public function __construct(
        Context $context,
        \Tasks\BlogManager\Model\BlogFactory $blogFactory,
        Session $customerSession,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->blogFactory = $blogFactory;
        $this->customerSession = $customerSession;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $blogId = $this->getRequest()->getParam('id');
        $customerId = $this->customerSession->getCustomerId();
        $isAuthorised = $this->blogFactory->create()
                                    ->getCollection()
                                    ->addFieldToFilter('user_id', $customerId)
                                    ->addFieldToFilter('entity_id', $blogId)
                                    ->getSize();
        if (!$isAuthorised) {
            $this->messageManager->addError(__('You are not authorised to delete this blog.'));
            return $this->resultRedirectFactory->create()->setPath('blog/manage');
        } else {
            $model = $this->blogFactory->create()->load($blogId);
            $model->delete();
            $this->messageManager->addSuccess(__('You have successfully deleted the blog.'));
        }     
        return $this->resultRedirectFactory->create()->setPath('blog/manage');
    }
}