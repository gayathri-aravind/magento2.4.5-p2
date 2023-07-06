<?php
namespace Tasks\BlogManager\Block;

class BlogList extends \Magento\Framework\View\Element\Template
{
    public $blogCollection;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Tasks\BlogManager\Model\ResourceModel\Blog\CollectionFactory $blogCollection,
        array $data = []
    ) {
        $this->blogCollection = $blogCollection;
        parent::__construct($context, $data);
    }

    public function getBlogs()
    {
        $collection = $this->blogCollection->create();
        return $collection;
    }
}