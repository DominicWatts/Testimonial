<?php


namespace Xigen\Testimonial\Controller\Adminhtml\Testimonial;

/**
 * Index controller class
 */
class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Xigen\Testimonial\Model\TestimonialFactory $testimonialFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->testimonialFactory = $testimonialFactory;
        parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__("Testimonial"));
        return $resultPage;
    }
}
