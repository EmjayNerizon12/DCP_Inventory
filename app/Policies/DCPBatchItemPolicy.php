<?php

namespace App\Policies;

use App\Models\DCPBatchItem;
use App\Models\SchoolUser;
use Illuminate\Auth\Access\Response;

class DCPBatchItemPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function search(SchoolUser $schoolUser): bool
    {
        return $schoolUser->pk_school_id !== null;
    }
    public function viewAny(SchoolUser $schoolUser): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(SchoolUser $schoolUser, DCPBatchItem $dCPBatchItem): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(SchoolUser $schoolUser): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(SchoolUser $schoolUser, DCPBatchItem $dCPBatchItem): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(SchoolUser $schoolUser, DCPBatchItem $dCPBatchItem): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(SchoolUser $schoolUser, DCPBatchItem $dCPBatchItem): bool
    {
        return false;
    }


    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(SchoolUser $schoolUser, DCPBatchItem $dCPBatchItem): bool
    {
        return false;
    }
}
