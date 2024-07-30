<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Job extends Model
{
    use HasFactory;

    public static function jobItem(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Senior Laravel Developer',
                'salary' => '$100, 000',
            ],
            [
                'id' => 2,
                'title' => 'Programmer',
                'salary' => '$10, 000'
            ],
            [
                'id' => 3,
                'title' => 'Teacher',
                'salary' => '$50, 000'
            ]
        ];
    }

    public static function find(int $id): array
    {
        $jobs = Arr::first(static::jobItem(), fn ($item) => $item['id'] === $id);

        if (!$jobs) {
            abort(404);
        }

        return $jobs;
    }
}
