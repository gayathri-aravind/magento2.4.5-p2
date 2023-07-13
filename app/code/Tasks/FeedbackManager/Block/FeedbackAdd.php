<?php
namespace Tasks\FeedbackManager\Block;

class FeedbackAdd extends \Magento\Framework\View\Element\Template
{
   
     /** @var SessionFactory */
     protected $session;

     /** @var */
     protected $customerData;
 
     /**
      * Feedback constructor.
      * @param Template\Context $context
      * @param SessionFactory $session
      * @param array $data
      */
 
     public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\SessionFactory $session,
         array $data = []
     )
     {
         parent::__construct($context, $data);
         $this->session= $session->create();
         $this->customerData = ($this->session->isLoggedIn()) ? $this->session->getCustomerData() : null;
     }
 
     
     public function getCustomerFirstName()
     {
        if(!$this->customerData) return false;
        return $this->customerData->getFirstname();   
     }
 
     public function getCustomerLastName()
     {
        if(!$this->customerData) return false;
        return $this->customerData->getLastname();  
     }
 
     public function getCustomerEmail()
     {
        if(!$this->customerData) return false;
        return $this->customerData->getEmail();   
     }
}