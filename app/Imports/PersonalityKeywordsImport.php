<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class PersonalityKeywordsImport implements WithMultipleSheets 
{
    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            'Extraversion' => new FirstSheetImport(),
            'Agreeableness' => new SecondSheetImport(),
            'Neuroticism' => new ThirdSheetImport(),
            'Conscientiousness' => new FourthSheetImport(),
            'Openness' => new FifthSheetImport(),
        ];
    }
}

class FirstSheetImport implements WithMultipleSheets, ToArray, WithHeadingRow
{
    public function sheets(): array
    {
        return [
            0 => $this,
        ];
    }
    public function array(array $rows)
    {
        foreach ($rows as $row) {
            $row = $row->toArray();
        }
        return $this->data;
    }
}

class SecondSheetImport implements WithMultipleSheets, ToArray, WithHeadingRow
{
    public function sheets(): array
    {
        return [
            1 => $this,
        ];
    }
    public function array(array $rows)
    {
        foreach ($rows as $row) {
            $row = $row->toArray();
        }
        return $this->data;
    }
}

class ThirdSheetImport implements WithMultipleSheets, ToArray, WithHeadingRow
{
    public function sheets(): array
    {
        return [
            2 => $this,
        ];
    }
    public function array(array $rows)
    {
        foreach ($rows as $row) {
            $row = $row->toArray();
        }
        return $this->data;
    }
}

class FourthSheetImport implements WithMultipleSheets, ToArray, WithHeadingRow
{
    public function sheets(): array
    {
        return [
            3 => $this,
        ];
    }
    public function array(array $rows)
    {
        foreach ($rows as $row) {
            $row = $row->toArray();
        }
        return $this->data;
    }
}

class FifthSheetImport implements WithMultipleSheets, ToArray, WithHeadingRow
{
    public function sheets(): array
    {
        return [
            4 => $this,
        ];
    }
    public function array(array $rows)
    {
        foreach ($rows as $row) {
            $row = $row->toArray();
        }
        return $this->data;
    }
}

