<?php

use App\Entities\Project;
use App\Entities\Category;
use App\Entities\Address;
use App\Entities\Province;
use Illuminate\Support\Facades\DB;

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

function getProjectCategoriesWithProjectCount()
{
    return Category::query()
        ->select('*', DB::raw("(select count(id) from projects where status = 2 and category_id = categories.id) as total_projects"))
        ->where('destination_entity', '=', Project::class)
        ->get();
}

function getProvincesInProjectCategory($categoryId)
{
    return Province::query()->whereIn(
        'id',
        Address::query()
            ->select('addresses.province_id')
            ->join('projects', 'projects.id', '=', 'addresses.addressable_id')
            ->where('addresses.addressable_type', '=', Project::class)
            ->where('projects.category_id', '=', $categoryId)
    )->get();
}
