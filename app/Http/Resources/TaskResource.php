<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\UserCrudResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public static $wrap = false;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image_path' => $this->image_path ? Storage::url($this->image_path) : asset('images/Default.webp'),
            'status' => $this->status,
            'priority' => $this->priority,
            'due_date' => (new Carbon($this->due_date))->format('Y-m-d'),
            'assignedUser' => $this->assignedUser ? new UserResource($this->assignedUser) : null,
            'assigned_user_id' => $this->assignedUser->id,
            'createdBy' => new UserCrudResource($this->createdBy),
            'updatedBy' => new UserCrudResource($this->updatedBy),
            'project' => new ProjectResource($this->project),
            'project_id' => $this->project->id,
            'created_at' => (new Carbon($this->created_at))->format('Y-m-d'),
        ];
    }
}
