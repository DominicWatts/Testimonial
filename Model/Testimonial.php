<?php


namespace Xigen\Testimonial\Model;

use Xigen\Testimonial\Api\Data\TestimonialInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Xigen\Testimonial\Api\Data\TestimonialInterface;

/**
 * Testimonial model class
 */
class Testimonial extends \Magento\Framework\Model\AbstractModel
{
    protected $testimonialDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'xigen_testimonial_testimonial';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param TestimonialInterfaceFactory $testimonialDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Xigen\Testimonial\Model\ResourceModel\Testimonial $resource
     * @param \Xigen\Testimonial\Model\ResourceModel\Testimonial\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        TestimonialInterfaceFactory $testimonialDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Xigen\Testimonial\Model\ResourceModel\Testimonial $resource,
        \Xigen\Testimonial\Model\ResourceModel\Testimonial\Collection $resourceCollection,
        array $data = []
    ) {
        $this->testimonialDataFactory = $testimonialDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve testimonial model with testimonial data
     * @return TestimonialInterface
     */
    public function getDataModel()
    {
        $testimonialData = $this->getData();
        
        $testimonialDataObject = $this->testimonialDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $testimonialDataObject,
            $testimonialData,
            TestimonialInterface::class
        );
        
        return $testimonialDataObject;
    }
}
