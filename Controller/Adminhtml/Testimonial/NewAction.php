<?php

namespace Xigen\Testimonial\Controller\Adminhtml\Testimonial;

/**
 * NewAction controller class
 */
class NewAction extends \Xigen\Testimonial\Controller\Adminhtml\Testimonial
{
    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var \Xigen\Testimonial\Model\TestimonialFactory
     */
    protected $testimonialFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Xigen\Testimonial\Model\TestimonialFactory $testimonialFactory
    ) {
        $this->resultForwardFactory = $resultForwardFactory;
        $this->testimonialFactory = $testimonialFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * New action
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Forward $resultForward */
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}
