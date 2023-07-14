<?php

namespace Tasks\FeedbackManager\Controller\Manage;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Tasks\FeedbackManager\Model\Feedback;
use Tasks\FeedbackManager\Model\ResourceModel\Feedback\CollectionFactory;

class ApprovedFeedback implements \Magento\Framework\App\ActionInterface
{
    /** @var JsonFactory */
    protected $jsonFactory;

    /** @var Feedback */
    protected $feedbackModel;

    /** @var ScopeConfigInterface */
    protected $scopeConfig;

    /** @var CollectionFactory */
    protected $collectionFactory;

    /**
     * ApprovedFeedback constructor.
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param Feedback $feedbackModel
     * @param ScopeConfigInterface $scopeConfig
     * @param CollectionFactory $collectionFactory,
     */

    public function __construct(
        JsonFactory $jsonFactory,
        Feedback $feedbackModel,
        ScopeConfigInterface $scopeConfig,
        CollectionFactory $collectionFactory
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->feedbackModel = $feedbackModel;
        $this->scopeConfig = $scopeConfig;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Execute action based on request and return result
     * Note: Request will be added as operation argument in future
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $result = $this->jsonFactory->create();
        $response['feedback_status'] = false;
        $response['data'] = $this->getApprovedFeedback();

        if (!empty($response['data'])) {
            $response['feedback_status'] = true;
        }

        $result->setData($response);
        return $result;
    }

    /** @return array firstname, lastname, emailId, feedback from feedback database */
    public function getApprovedFeedback()
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToSelect(array('customer_firstname', 'customer_lastname', 'customer_email', 'comment'))
            ->addFieldToFilter('status', ['eq' => 1]);

        return (array) $collection->getData();
    }
}
