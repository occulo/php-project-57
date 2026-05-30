<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Label;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labels = [
            ['name' => 'needs-review', 'description' => 'Работа завершена и ожидает ревью'],
            ['name' => 'needs-testing', 'description' => 'Реализация завершена и требует тестирования'],
            ['name' => 'needs-work', 'description' => 'Требуются доработки'],
            ['name' => 'on-hold', 'description' => 'Временно приостановлено из-за более приоритетных задач или других причин'],
            ['name' => 'wontfix', 'description' => 'Не планируется к исправлению/выходит за рамки проекта'],
            ['name' => 'blocked', 'description' => 'Невозможно продолжить выполнение'],
        ];
        foreach ($labels as $label) {
            Label::create($label);
        }
    }
}
