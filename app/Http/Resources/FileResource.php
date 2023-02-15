<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'folder_id' => $this->folder_id,
            'user_id' => $this->user_id,
            'user' => $this->user,
            'fileType' => $this->getFileType(),
            'fileName' => $this->getFileName(),
            'fileSize' => $this->getFileSize(),
            'path' => $this->path,
            'size' => $this->size,
            'duplicateFiles' => FileReportResource::collection($this->getDuplicateFiles()),
            'created_at' => $this->created_at->format('Y-m-d H:i:s a'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s a'),
        ];
    }
}
