<?php

namespace App\Repositories\Pets;

class StatusesRepository
{

    public function getStatues()
    {
        $statuses = [
            ['value' => "available",    'name' => 'Dostepny'],
            ['value' => "pending",      'name' => 'Nierozstrzygnięty'],
            ['value' => "sold",         'name' => 'Sprzedany'],
        ];

        return $statuses;
    }


}