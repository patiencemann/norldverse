<?php

    namespace App\Http\Resources\Public;

    use Illuminate\Http\Resources\Json\JsonResource;

    class DocTopicResource extends JsonResource {
        /**
         * Transform the resource into an array.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
         */
        public function toArray($request) {
            return [
                'id' => $this->id,
                'topics' => $this->topics,
                "created_at" => $this->created_at->toDateTimeString()
            ];
        }
    }
