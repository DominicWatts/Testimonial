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
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var Context
     */
    private $context;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var TestimonialFactory
     */
    private $testimonialFactory;

    /**
     * @param Context $context
     * @param ConfigInterface $contactsConfig
     * @param MailInterface $mail
     * @param DataPersistorInterface $dataPersistor
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        LoggerInterface $logger = null,
        TestimonialFactory $testimonialFactory
    ) {
        parent::__construct($context);
        $this->context = $context;
        $this->dataPersistor = $dataPersistor;
        $this->logger = $logger ?: ObjectManager::getInstance()->get(LoggerInterface::class);
        $this->testimonialFactory = $testimonialFactory;
    }
    /**
     * Post user question
     *
     * @return Redirect
     */
    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        try {
            $post = $this->getRequest()->getPostValue();
            $testimonial = $this->testimonialFactory->create();
            $testimonial->setName($post['name']);
            $testimonial->setEmail($post['email']);
            $testimonial->setSubject($post['subject']);
            $testimonial->setComment($post['comment']);
            $testimonial->save();

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
        if (false === \strpos($request->getParam('email'), '@')) {
            throw new LocalizedException(__('The email address is invalid. Verify the email address and try again.'));
        }
        if (trim($request->getParam('hideit')) !== '') {
            throw new \Exception();
        }
        return $request->getParams();
    }
}
