<?php

namespace App\Policies\File;

use App\FileReport;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        return $user->inRole('administrator');
    }

    /**
     * Determine whether the user can view the report.
     *
     * @param  \App\User  $user
     * @param  \App\File\Report  $report
     * @return mixed
     */
    public function view(User $user, FileReport $report)
    {
        return $user->inRole('administrator');
    }

    /**
     * Determine whether the user can create reports.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasAccess(['report.create']);
    }

    /**
     * Determine whether the user can update the report.
     *
     * @param  \App\User  $user
     * @param  \App\File\Report  $report
     * @return mixed
     */
    public function update(User $user, FileReport $report)
    {
        //
    }

    /**
     * Determine whether the user can delete the report.
     *
     * @param  \App\User  $user
     * @param  \App\File\Report  $report
     * @return mixed
     */
    public function delete(User $user, FileReport $report)
    {
        //
    }
}
