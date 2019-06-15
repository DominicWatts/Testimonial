<?php


namespace Xigen\Testimonial\Api\Data;

interface TestimonialInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const NAME = 'name';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const EMAIL = 'email';
    const SUBJECT = 'subject';
    const COMMENT = 'comment';
    const UPDATED_AT = 'updated_at';
    const TESTIMONIAL_ID = 'testimonial_id';

    /**
     * Get testimonial_id
     * @return string|null
     */
    public function getTestimonialId();

    /**
     * Set testimonial_id
     * @param string $testimonialId
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setTestimonialId($testimonialId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setName($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Xigen\Testimonial\Api\Data\TestimonialExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Xigen\Testimonial\Api\Data\TestimonialExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Xigen\Testimonial\Api\Data\TestimonialExtensionInterface $extensionAttributes
    );

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setEmail($email);

    /**
     * Get subject
     * @return string|null
     */
    public function getSubject();

    /**
     * Set subject
     * @param string $subject
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setSubject($subject);

    /**
     * Get comment
     * @return string|null
     */
    public function getComment();

    /**
     * Set comment
     * @param string $comment
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setComment($comment);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setStatus($status);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setCreatedAt($createdAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setUpdatedAt($updatedAt);
}
