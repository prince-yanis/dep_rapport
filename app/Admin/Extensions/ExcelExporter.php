<?php

namespace App\Admin\Extensions;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Illuminate\Support\Collection;

class ExcelExporter implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithTitle
{
    protected string $resource;
    protected array $columns;
    protected Collection $data;

    public function __construct(string $resource, array $columns, $data)
    {
        $this->resource = $resource;
        $this->columns  = $columns;
        $this->data     = $data instanceof Collection ? $data : collect($data);
    }

    public function collection(): Collection
    {
        return $this->data->map(function ($row) {
            $mapped = [];
            foreach (array_keys($this->columns) as $key) {
                $value = $row->{$key} ?? '';

                // Normalize boolean-like fields
                if ($key === 'statut') {
                    $value = $value ? 'Actif' : 'Inactif';
                }

                // Format dates
                if (in_array($key, ['created_at', 'updated_at']) && $value) {
                    $value = \Carbon\Carbon::parse($value)->format('d/m/Y H:i');
                }

                $mapped[] = $value;
            }
            return $mapped;
        });
    }

    public function headings(): array
    {
        return array_values($this->columns);
    }

    public function title(): string
    {
        return ucfirst($this->resource);
    }

    public function styles(Worksheet $sheet): array
    {
        $lastCol = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex(count($this->columns));
        $lastRow = $this->data->count() + 1;

        return [
            // Header row: bold, white text, blue background
            1 => [
                'font'      => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill'      => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['argb' => 'FF1F4E79']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
            ],
            // All data cells: borders + wrap
            "A1:{$lastCol}{$lastRow}" => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color'       => ['argb' => 'FFB0C4DE'],
                    ],
                ],
                'alignment' => ['wrapText' => true, 'vertical' => Alignment::VERTICAL_TOP],
            ],
        ];
    }
}
