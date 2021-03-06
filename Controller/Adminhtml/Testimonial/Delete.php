<?php

namespace Xigen\Testimonial\Controller\Adminhtml\Testimonial;

/**
 * Testimonials delete controller class
 */
class Delete extends \Xigen\Testimonial\Controller\Adminhtml\Testimonial
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    /**
     * @var \Xigen\Testimonial\Model\TestimonialFactory
     */
    private $testimonialFactory;

    /**
     * Delete constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Xigen\Testimonial\Model\TestimonialFactory $testimonialFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Xigen\Testimonial\Model\TestimonialFactory $testimonialFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->testimonialFactory = $testimonialFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Delete action
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('testimonial_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->testimonialFactory->create();
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Testimonial.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['testimonial_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Testimonial to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
