<?php

declare(strict_types=1);

namespace Training\Example\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\Controller\Result\ForwardFactory;

class Forward implements ActionInterface
{

    protected $forwardFactory;

    public function __construct(ForwardFactory $forwardFactory)
    {

        $this->forwardFactory = $forwardFactory;

    }

    public function execute()
    {
        // $this->forwardFactory->create() - creates a new instance of the Magento\Framework\Controller\Result\Forward class and invoking the forward() method of the Forward class using it's instance.
        // 'page' is the controller(app/code/Training/Example/Controller/Index/Page) to forward. Since 'Page', 'Forward' are all within the same folder app/code/Training/Example/Controller/Index, mentioning only the controller name within forward().
        return $this->forwardFactory->create()->forward('page');
    }
}

?>