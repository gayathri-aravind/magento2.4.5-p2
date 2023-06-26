<?php

declare(strict_types=1);

namespace Training\Example\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\RawFactory;

class Index implements ActionInterface
{

    protected $resultFactory;

    public function __construct(RawFactory $resultFactory)
    {

        $this->resultFactory = $resultFactory;

    }

    public function execute()
    {
        // $this->resultFactory->create() - creates a new instance of the Magento\Framework\Controller\Result\Raw class and invoking the setContents() method of the Raw class using it's instance.
        return $this->resultFactory->create()->setContents('Frontend Controller - Training / Example');

    }
}

?>