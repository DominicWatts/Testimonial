<?php

namespace Xigen\Testimonial\Controller\Adminhtml\Testimonial;

/**
 * Edit controller class
 */
class Edit extends \Xigen\Testimonial\Controller\Adminhtml\Testimonial
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var \Xigen\Testimonial\Model\TestimonialFactory
     */
    protected $testimonialFactory;

    /**
     * Edit constructor.
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
     * Edit action
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('testimonial_id');
        $model = $this->testimonialFactory->create();

        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This Testimonial no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('xigen_testimonial_testimonial', $model);

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Testimonial') : __('New Testimonial'),
            $id ? __('Edit Testimonial') : __('New Testimonial')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Testimonials'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Testimonial %1', $model->getId()) : __('New Testimonial'));
        return $resultPage;
    }
}
