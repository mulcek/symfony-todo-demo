<?php

/*
 * This file is overrides softDeletableMethods KnpDoctrineBehaviors package.
 */

namespace AppBundle\Entity\Traits;

/**
 * SoftDeletable trait.
 *
 * Should be used inside entity, that needs to be self-deleted.
 */
trait SoftDeletableMethodsTrait
{
    /**
     * Set the delete date to given date. This one allows null values to be had -> so it can work as restore
     *
     * @param DateTime $date
     *
     * @return $this
     */
    public function setDeletedAt(\DateTime $date = null)
    {
        $this->deletedAt = $date;

        return $this;
    }
}
