<?php
namespace Training\MyModule\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Training\MyModule\Model\ResourceModel\View\CollectionFactory as ViewCollectionFactory;
use \Training\MyModule\Model\View;

class Article extends Template
{
    /**
     * CollectionFactory
     * @var null|CollectionFactory
     */
    protected ViewCollectionFactory $viewCollectionFactory;

     /**
     * Constructor
     *
     * @param Context $context
     * @param ViewCollectionFactory $viewCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        ViewCollectionFactory $viewCollectionFactory,
        array $data = []
    ) {
        $this->viewCollectionFactory  = $viewCollectionFactory;
        parent::__construct($context, $data);
    }

     /**
     * @return Post[]
     */
    public function getCollection()
    {
        /** @var ViewCollection $viewCollection */
        $viewCollection = $this->viewCollectionFactory ->create();
        $viewCollection->addFieldToSelect('*')
        ->addFieldToFilter('article_id', 1)
        ->load();
        return $viewCollection->getItems();
    }

    /**
     * For a given post, returns its url
     * @param Post $post
     * @return string
     */
    public function getArticleUrl(View $view) {
         //return $this->getUrl('blog/index/view/'.$viewId, ['_secure' => true]);
         return '/mymodule/view/id/'. $view->getId(); 
    }

    /**
     * @return Post[]
    */
    // public function getArticles()
    // {
    //     return 'getArticles function of the Block class called successfully';
    // }
}
?>