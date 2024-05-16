<?php

namespace App\Repositories\Pets;

class TagsRepository
{
    public function getTags()
    {
        $tags = [
            ['value' => "gourmand",   'name' => 'Łasuch'],
            ['value' => "hairy",      'name' => 'Sierściuch']
        ];

        return $tags;
    }


}