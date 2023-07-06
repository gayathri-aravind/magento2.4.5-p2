<?php
namespace Tasks\BlogManager\Controller\Manage;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session;

class Edit extends AbstractAccount
{
    protected $resultPageFactory;
    protected $blogFactory;
    protected $customerSession;
    protected $messageManager;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Tasks\BlogManager\Model\BlogFactory $blogFactory,
        Session $customerSession,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
    $this->resultPageFactory = $resultPageFactory;
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

        // SELECT COUNT(*) FROM blogmanager_blog WHERE user_id=$customerId AND entity_id=$blogID;
        // getSize() - The getSize will return the count, i.e. the number of rows or models in the collection. 
        
        if (!$isAuthorised) {
            $this->messageManager->addError(__('You are not authorised to edit this blog.'));
            return $this->resultRedirectFactory->create()->setPath('blog/manage');
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Edit Blog'));
        $layout = $resultPage->getLayout();
        return $resultPage;
    }
}