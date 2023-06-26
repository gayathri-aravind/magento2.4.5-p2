<?php

declare(strict_types=1);

namespace Training\Example\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;

class Json implements ActionInterface
{

    protected $redirectFactory;

    public function __construct(JsonFactory $jsonFactory)
    {

        $this->jsonFactory = $jsonFactory;

    }

    public function execute()
    {
        // $this->redirectFactory->create() - creates a new instance of the Magento\Framework\Controller\Result\JsonFactory class and invoking the setHeader() method of the Magento\Framework\Controller\Result\Json class using it's instance.
        // mention the complete page url after the domain withn the setUrl() method
        return $this->jsonFactory->create()
                ->setHeader('Content-Type','application/json')
                ->setData([
                    'name' => 'Siva',
                    'favourite color' => 'green'
                ]);
    }
}

?>