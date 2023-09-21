<?php

namespace App\Repositories;

use App\Models\Chat\Group;
use App\Models\Chat\GroupMembers;

class ChatRepository
{
    private Group $group;

    private GroupMembers $groupMembers;

    public function __construct(
        Group $group,
        GroupMembers $groupMembers
    ) {
        $this->group = $group;
        $this->groupMembers = $groupMembers;
    }

    public function getAllGroup($request)
    {
        $result = $this->group;

        $result = $this->groupMembers->leftJoin('groups', 'group_members.group_id', '=', 'groups.id')
            ->where('group_members.member_id', userInfo()->id)
            ->groupBy('group_members.group_id', 'groups.name', 'groups.details', 'groups.total_members', 'groups.created_by', 'groups.id')
            ->select('groups.name', 'groups.details', 'groups.total_members', 'groups.created_by', 'groups.id')
            ->orderBy('groups.id', 'desc');

        if ($request->name != null) {
            $result = $result->where('name', 'LIKE', '%'.$request->name.'%');
        }

        if ($request->details != null) {
            $result = $result->where('details', 'LIKE', '%'.$request->details.'%');
        }

        if ($request->total_members != null) {
            $result = $result->where('total_members', $request->total_members);
        }

        return $result
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }
}
