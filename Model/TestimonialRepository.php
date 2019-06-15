<?php


namespace Xigen\Testimonial\Model;

use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Xigen\Testimonial\Api\Data\TestimonialSearchResultsInterfaceFactory;
use Xigen\Testimonial\Api\TestimonialRepositoryInterface;
use Xigen\Testimonial\Api\Data\TestimonialInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Xigen\Testimonial\Model\ResourceModel\Testimonial as ResourceTestimonial;
use Xigen\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory as TestimonialCollectionFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Reflection\DataObjectProcessor;

/**
 * Testimonial Repository class
 */
class TestimonialRepository implements TestimonialRepositoryInterface
{
    protected $resource;

    protected $extensionAttributesJoinProcessor;

    protected $extensibleDataObjectConverter;
    protected $testimonialFactory;

    protected $testimonialCollectionFactory;

    protected $dataObjectProcessor;

    private $storeManager;

    protected $dataTestimonialFactory;

    private $collectionProcessor;

    protected $dataObjectHelper;

    protected $searchResultsFactory;

    /**
     * @param ResourceTestimonial $resource
     * @param TestimonialFactory $testimonialFactory
     * @param TestimonialInterfaceFactory $dataTestimonialFactory
     * @param TestimonialCollectionFactory $testimonialCollectionFactory
     * @param TestimonialSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceTestimonial $resource,
        TestimonialFactory $testimonialFactory,
        TestimonialInterfaceFactory $dataTestimonialFactory,
        TestimonialCollectionFactory $testimonialCollectionFactory,
        TestimonialSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->testimonialFactory = $testimonialFactory;
        $this->testimonialCollectionFactory = $testimonialCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataTestimonialFactory = $dataTestimonialFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Xigen\Testimonial\Api\Data\TestimonialInterface $testimonial
    ) {
        /* if (empty($testimonial->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $testimonial->setStoreId($storeId);
        } */
        
        $testimonialData = $this->extensibleDataObjectConverter->toNestedArray(
            $testimonial,
            [],
            \Xigen\Testimonial\Api\Data\TestimonialInterface::class
        );
        
        $testimonialModel = $this->testimonialFactory->create()->setData($testimonialData);
        
        try {
            $this->resource->save($testimonialModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the testimonial: %1',
                $exception->getMessage()
            ));
        }
        return $testimonialModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($testimonialId)
    {
        $testimonial = $this->testimonialFactory->create();
        $this->resource->load($testimonial, $testimonialId);
        if (!$testimonial->getId()) {
            throw new NoSuchEntityException(__('Testimonial with id "%1" does not exist.', $testimonialId));
        }
        return $testimonial->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->testimonialCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Xigen\Testimonial\Api\Data\TestimonialInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Xigen\Testimonial\Api\Data\TestimonialInterface $testimonial
    ) {
        try {
            $testimonialModel = $this->testimonialFactory->create();
            $this->resource->load($testimonialModel, $testimonial->getTestimonialId());
            $this->resource->delete($testimonialModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Testimonial: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($testimonialId)
    {
        return $this->delete($this->getById($testimonialId));
    }
}
