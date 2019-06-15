<?php


namespace Xigen\Testimonial\Api\Data;

interface TestimonialSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Testimonial list.
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Xigen\Testimonial\Api\Data\TestimonialInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
