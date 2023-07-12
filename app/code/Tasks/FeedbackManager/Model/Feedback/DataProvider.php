<?php
namespace Tasks\FeedbackManager\Model\Feedback;

use Magento\Framework\Data\OptionSourceInterface;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Tasks\FeedbackManager\Model\ResourceModel\Feedback\CollectionFactory $feedbackCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $feedbackCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) return $this->loadedData;
            
        $items = $this->collection->getItems();
        foreach ($items as $feedback) {
            $this->loadedData[$feedback->getId()] = $feedback->getData();
        }
        return $this->loadedData;
    }
}