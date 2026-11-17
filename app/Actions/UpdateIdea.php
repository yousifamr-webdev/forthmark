<?php

namespace App\Actions;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Attributes\CurrentUser;


class UpdateIdea
{

    public function handle(array $attributes, Idea $idea)
    {

        $data = collect($attributes)->only([
            'title',
            'description',
            'status',
            'links'
        ])->toArray();

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('ideas', 'neon');
        }


        DB::transaction(function () use ($idea, $data, $attributes) {

            $idea->update($data);

            $idea->steps()->delete();

            $idea->steps()->createMany($attributes['steps'] ?? []);
    
        });
    }
}
