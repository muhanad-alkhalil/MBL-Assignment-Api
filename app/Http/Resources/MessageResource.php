<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="MessageResource",
 *     description="Message resource",
 *     @OA\Xml(
 *         name="MessageResource"
 *     ),
 *     @OA\Property(
 *          property="id",
 *          type="number",
 *          example="1"
 *       ),
 *       @OA\Property(
 *          property="subject",
 *          type="string",
 *          example="Title"
 *       ),
 *       @OA\Property(
 *          property="content",
 *          type="string",
 *          example="Message Content"
 *       ),
 *       @OA\Property(
 *          property="isRead",
 *          type="boolean",
 *          example="0"
 *       ),
 * )
 */
class MessageResource extends JsonResource
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
            'subject' => $this->subject,
            'content' => $this->content,
            'isRead' => $this->isRead,
        ];
    }
}
