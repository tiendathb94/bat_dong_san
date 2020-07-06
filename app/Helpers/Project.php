<?php

use App\Entities\Project;

function getProjectsInLocation($address, $limit, $notIn = [])
{
    $projects = [];

    // Get by ward
    if (!empty($address['ward_id'])) {
        $qb = Project::query()->limit($limit)->whereHas('address',
            function ($query) use ($address) {
                $query->where('ward_id', '=', $address['ward_id']);
            }
        )->where('status', '=', Project::StatusApproved);

        if (count($notIn) > 0) {
            $qb->whereNotIn('id', $notIn);
        }

        $projects = $qb->get();
    }

    if ($projects->count() < $limit) {
        // Get by district
        if (!empty($address['district_id'])) {
            $qb = Project::query()->limit($limit - $projects->count())->whereHas('address',
                function ($query) use ($address) {
                    $query->where('district_id', '=', $address['district_id']);
                }
            )->where('status', '=', Project::StatusApproved);

            if (count($notIn) > 0) {
                $qb->whereNotIn('id', $notIn);
            }

            $projects = $projects->merge($qb->get());
        }
    }

    if ($projects->count() < $limit) {
        // Get by district
        if (!empty($address['province_id'])) {
            $qb = Project::query()->limit($limit - $projects->count())->whereHas('address',
                function ($query) use ($address) {
                    $query->where('province_id', '=', $address['province_id']);
                }
            )->where('status', '=', Project::StatusApproved);

            if (count($notIn) > 0) {
                $qb->whereNotIn('id', $notIn);
            }

            $projects = $projects->merge($qb->get());
        }
    }

    return $projects;
}

