<?php


namespace Xigen\Testimonial\Model\Data;

use Xigen\Testimonial\Api\Data\TestimonialInterface;

/**
 * Testimonial interface
 */
class Testimonial extends \Magento\Framework\Api\AbstractExtensibleObject implements TestimonialInterface
{

    /**
     * Get testimonial_id
     * @return string|null
     */
    public function getTestimonialId()
    {
        return $this->_get(self::TESTIMONIAL_ID);
    }

    /**
     * Set testimonial_id
     * @param string $testimonialId
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setTestimonialId($testimonialId)
    {
        return $this->setData(self::TESTIMONIAL_ID, $testimonialId);
    }

    /**
     * Get name
     * @return string|null
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Xigen\Testimonial\Api\Data\TestimonialExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Xigen\Testimonial\Api\Data\TestimonialExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Xigen\Testimonial\Api\Data\TestimonialExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get email
     * @return string|null
     */
    public function getEmail()
    {
        return $this->_get(self::EMAIL);
    }

    /**
     * Set email
     * @param string $email
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get subject
     * @return string|null
     */
    public function getSubject()
    {
        return $this->_get(self::SUBJECT);
    }

    /**
     * Set subject
     * @param string $subject
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setSubject($subject)
    {
        return $this->setData(self::SUBJECT, $subject);
    }

    /**
     * Get comment
     * @return string|null
     */
    public function getComment()
    {
        return $this->_get(self::COMMENT);
    }

    /**
     * Set comment
     * @param string $comment
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * Get status
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->_get(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $createdAt
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt()
    {
        return $this->_get(self::UPDATED_AT);
    }

    /**
     * Set updated_at
     * @param string $updatedAt
     * @return \Xigen\Testimonial\Api\Data\TestimonialInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
