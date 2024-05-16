<?php


namespace App\Repositories\Pets;




class CategoriesRepository
{

    public function getCategories()
    {
        $categories = [
            ['value' => "dog",      'name' => 'Pies'],
            ['value' => "cat",      'name' => 'Kot'],
            ['value' => "hamster",  'name' => 'Chomik'],
            ['value' => "parrot",   'name' => 'Papuga'],
            ['value' => "spider",   'name' => 'Pająk'],
            ['value' => "goldfish", 'name' => 'ZłotaRybka']
        ];

        return $categories;
    }


}