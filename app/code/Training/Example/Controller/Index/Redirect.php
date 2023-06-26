<?php

declare(strict_types=1);

namespace Training\Example\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\RedirectFactory;

class Redirect implements ActionInterface
{

    protected $redirectFactory;

    public function __construct(RedirectFactory $redirectFactory)
    {

        $this->redirectFactory = $redirectFactory;

    }

    public function execute()
    {
        // $this->redirectFactory->create() - creates a new instance of the Magento\Framework\Controller\Result\RedirectFactory class and invoking the setUrl() method of the Magento\Framework\Controller\Result\Redirect class using it's instance.
        // mention the complete page url after the domain withn the setUrl() method
        return $this->redirectFactory->create()->setUrl('/example/Index/page');
    }
}

?>