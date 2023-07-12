<?php
namespace Tasks\FeedbackManager\Block\Adminhtml;

class FeedbackView extends \Magento\Framework\View\Element\Template
{
    protected $feedbackCollection;

    protected $request;

    // protected $button;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        // \Magento\Backend\Block\Widget\Form\Container $button,
        \Tasks\FeedbackManager\Model\ResourceModel\Feedback\CollectionFactory $feedbackCollection,
        array $data = []
    ) {
        $this->feedbackCollection = $feedbackCollection;
        $this->request = $request;
        // $this->button = $button;

        // $this->addButton(
        //     'my_back_button',
        //     [
        //         'label' => __('My Back Button'),
        //         // 'onclick' => 'setLocation(\'' . $this->getUrl('router/controller/action') . '\')',
        //         'class' => 'back'
        //     ],
        //     -1
        // );

        parent::__construct($context, $data);
    }

    public function getDataById()
    {
        // print_r($this->request->getParams()); // all params
        $entityId = $this->request->getParam('id');

        $collection = $this->feedbackCollection->create();
        $collection->addFieldToFilter('entity_id', ['eq'=>$entityId]);

        return $collection;
    }

    public function getButtonsHtml(){
        
    
    }

}