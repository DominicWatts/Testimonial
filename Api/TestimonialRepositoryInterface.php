<?php


namespace Xigen\Testimonial\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface TestimonialRepositoryInterface
{

    /**
     * Save Testimonial
     * @param \Xigen\Testimonial\Api\Data\TestimonialInterface $testimonial
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Xigen\Testimonial\Api\Data\TestimonialInterface $testimonial
    );

    /**
     * Retrieve Testimonial
     * @param string $testimonialId
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($testimonialId);

    /**
     * Retrieve Testimonial matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Xigen\Testimonial\Api\Data\TestimonialSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Testimonial
     * @param \Xigen\Testimonial\Api\Data\TestimonialInterface $testimonial
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Xigen\Testimonial\Api\Data\TestimonialInterface $testimonial
    );

    /**
     * Delete Testimonial by ID
     * @param string $testimonialId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($testimonialId);
}
