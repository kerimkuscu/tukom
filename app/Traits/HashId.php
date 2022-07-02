<?php

namespace App\Traits;

trait HashId
{
    /**
     * Get hashed value of the model's key
     *
     * @return string
     */
    public function getHashedIdAttribute()
    {
        return hashids_encode($this->getKey());
    }

    /**
     * Get the value of the model's route key.
     *
     * @return string
     */
    public function getRouteKey()
    {
        return $this->getHashedIdAttribute();
    }
}
