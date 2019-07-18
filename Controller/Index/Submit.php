<?php

namespace Xigen\Testimonial\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\DataObject;
use Xigen\Testimonial\Model\TestimonialFactory;

/**
 * Submit Controller class
 */
class Submit extends \Magento\Framework\App\Action\Action
{

    /**
     * @var Context
     */
    protected $context;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var TestimonialFactory
     */
    private $testimonialFactory;

    /**
     * @var \Xigen\Testimonial\Api\Data\TestimonialInterfaceFactory
     */
    private $testimonialInterfaceFactory;

    /**
     * @var \Xigen\Testimonial\Api\TestimonialRepositoryInterface
     */
    private $testimonialRepositoryInterface;

    /**
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    private $formKeyValidator;

    /**
     * Submit constructor.
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param LoggerInterface|null $logger
     * @param TestimonialFactory $testimonialFactory
     * @param \Xigen\Testimonial\Api\Data\TestimonialInterfaceFactory $testimonialInterfaceFactory
     * @param \Xigen\Testimonial\Api\TestimonialRepositoryInterface $testimonialRepositoryInterface
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        LoggerInterface $logger = null,
        TestimonialFactory $testimonialFactory,
        \Xigen\Testimonial\Api\Data\TestimonialInterfaceFactory $testimonialInterfaceFactory,
        \Xigen\Testimonial\Api\TestimonialRepositoryInterface $testimonialRepositoryInterface,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
    ) {
        parent::__construct($context);
        $this->context = $context;
        $this->dataPersistor = $dataPersistor;
        $this->logger = $logger ?: ObjectManager::getInstance()->get(LoggerInterface::class);
        $this->testimonialFactory = $testimonialFactory;
        $this->testimonialInterfaceFactory = $testimonialInterfaceFactory;
        $this->testimonialRepositoryInterface = $testimonialRepositoryInterface;
        $this->formKeyValidator = $formKeyValidator;
    }

    /**
     * Post user question
     * @return Redirect
     */
    public function execute()
    {
        $request = $this->getRequest();

        if (!$request->isPost() ||
            !$this->formKeyValidator->validate($request)) {
            $this->messageManager->addErrorMessage(
                __("There was a problem with your submission. Please try again.")
            );
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }

        try {
            $post = $this->getRequest()->getPostValue();

            $testimonial = $this->testimonialInterfaceFactory
                ->create()
                ->setName($post['name'])
                ->setEmail($post['email'])
                ->setSubject($post['subject'])
                ->setComment($post['comment']);

            $testimonial = $this->testimonialRepositoryInterface->save($testimonial);

            $this->messageManager->addSuccessMessage(
                __('Thanks for providing us with your feedback.')
            );
            $this->dataPersistor->clear('testimonial');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->dataPersistor->set('testimonial', $this->getRequest()->getParams());
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
            $this->dataPersistor->set('testimonial', $this->getRequest()->getParams());
        }
        return $this->resultRedirectFactory->create()->setPath('*/index');
    }

    /**
     * @return array
     * @throws \Exception
     */
    private function validatedParams()
    {
        $request = $this->getRequest();
        if (trim($request->getParam('name')) === '') {
            throw new LocalizedException(__('Enter the Name and try again.'));
        }
        if (trim($request->getParam('comment')) === '') {
            throw new LocalizedException(__('Enter the comment and try again.'));
        }
        if (!\Zend_Validate::is(trim($request->getParam('email')), 'EmailAddress')) {
            throw new LocalizedException(__('The email address is invalid. Verify the email address and try again.'));
        }
        if (trim($request->getParam('hideit')) !== '') {
            throw new \LocalizedException();
        }
        return $request->getParams();
    }
}
