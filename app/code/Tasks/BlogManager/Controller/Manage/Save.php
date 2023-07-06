<?php
namespace Tasks\BlogManager\Controller\Manage;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;

class Save extends AbstractAccount
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
        $data = $this->getRequest()->getParams();
        // print_r($data); // Array ( [title] => s [content] => SS [form_key] => nLoX70SUSI2HAutJ )
        $model = $this->blogFactory->create();

        // Sets the form data
            // $model->setTitle($data['title']);
            // $model->setContent($data['content']);
            $model->setData($data);

        // Gets the loggedin customer ID and sets the value of the column (user_id) in the blogmanager_blog table
            $customer = $this->customerSession->getCustomer();
            $customerId = $customer->getId();
            $model->setUserId($customerId);

        $model->save();

        $this->messageManager->addSuccess(__('Blog saved successfully.'));
        
        return $this->resultRedirectFactory->create()->setPath('blog/manage');
    }
}