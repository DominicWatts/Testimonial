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
    /**
     * @var TestimonialInterfaceFactory
     */
    protected $testimonialDataFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var string
     */
    protected $_eventPrefix = 'xigen_testimonial_testimonial';

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    private $dateTime;

    /**
     * Testimonial constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param TestimonialInterfaceFactory $testimonialDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param ResourceModel\Testimonial $resource
     * @param ResourceModel\Testimonial\Collection $resourceCollection
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        TestimonialInterfaceFactory $testimonialDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Xigen\Testimonial\Model\ResourceModel\Testimonial $resource,
        \Xigen\Testimonial\Model\ResourceModel\Testimonial\Collection $resourceCollection,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        array $data = []
    ) {
        $this->testimonialDataFactory = $testimonialDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dateTime = $dateTime;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Before save
     */
    public function beforeSave()
    {
        $this->setUpdatedAt($this->dateTime->gmtDate());
        if ($this->isObjectNew()) {
            $this->setCreatedAt($this->dateTime->gmtDate());
        }
        return parent::beforeSave();
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
