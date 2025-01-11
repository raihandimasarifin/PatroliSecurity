<?php

namespace App\Exports;

use App\Models\Tracking;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithDrawings;

class TrackingExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnFormatting, WithDrawings
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Tracking::with(['room', 'user'])
                         ->orderBy('date', 'desc');

        if (!empty($this->filters['start_date'])) {
            $startDate = $this->filters['start_date'] . ' 00:00:00';
            $query->where('date', '>=', $startDate);
        }

        if (!empty($this->filters['end_date'])) {
            $endDate = $this->filters['end_date'] . ' 23:59:59';
            $query->where('date', '<=', $endDate);
        }

        if (!empty($this->filters['search'])) {
            $query->where(function ($q) {
                $q->whereHas('room', function ($qr) {
                    $qr->where('room', 'like', '%' . $this->filters['search'] . '%');
                })->orWhereHas('user', function ($qu) {
                    $qu->where('name', 'like', '%' . $this->filters['search'] . '%');
                });
            });
        }

        return $query->get()
        ->map(function($item, $index) {
            // Menambahkan nomor urut pada awal array
            $item->urut = $index + 1;
            return $item;
        });
    }

    /**
     * Define the headings for the Excel file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Ruangan',
            'Lantai',
            'Situasi',
            'Tanggal',
            'Foto',
            'Satpam'
        ];
    }

    /**
     * Map each row of data to an array for export.
     *
     * @param  \App\Models\Tracking  $tracking
     * @return array
     */
    public function map($tracking): array
    {
        return [
            $tracking->urut,
            $tracking->room->room,
            $tracking->room->floor,
            $tracking->situasi,
            $tracking->date,
            $tracking->foto ? '' : 'Tidak ada gambar',
            $tracking->user->name
        ];
    }

    /**
     * Style the Excel sheet.
     *
     * @param  \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet  $sheet
     * @return \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
     */
    public function styles(Worksheet $sheet)
    {
        // Set the header row to bold
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);

        // Set the column width for a better display
        $sheet->getColumnDimension('A')->setWidth(5);  // No column
        $sheet->getColumnDimension('B')->setWidth(20); // Room column
        $sheet->getColumnDimension('C')->setWidth(10); // Floor column
        $sheet->getColumnDimension('D')->setWidth(25); // Situasi column
        $sheet->getColumnDimension('E')->setWidth(20); // Date column
        $sheet->getColumnDimension('F')->setWidth(25); // Foto column
        $sheet->getColumnDimension('G')->setWidth(20); // Security column

        // Center align the content for all rows
        // $sheet->getStyle('A1:G1000')->getAlignment()->setHorizontal('center');

        $sheet->getStyle('A1:G1000')->getAlignment()
        ->setHorizontal('center')
        ->setVertical('center');

        // Add borders around the entire data area
        $sheet->getStyle('A1:G1000')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        $sheet->getDefaultRowDimension()->setRowHeight(50);
        return $sheet;
    }

    /**
     * Format the Date column.
     *
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'E' => 'yyyy-mm-dd hh:mm:ss',  // Date format
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $trackings = $this->collection();

        foreach ($trackings as $index => $tracking) {
            if ($tracking->foto) {
                $drawing = new Drawing();
                $drawing->setName('Foto');
                $drawing->setDescription('Foto dari ' . $tracking->room->room);
                $drawing->setPath(storage_path('app/public/' . $tracking->foto));
                $drawing->setHeight(50); // Set tinggi gambar
                $drawing->setCoordinates('F' . ($index + 2)); // Foto dimulai dari baris ke-2 (header ada di baris 1)
                $drawing->setOffsetX(10);  // Untuk menyesuaikan gambar ke tengah secara horizontal
                $drawing->setOffsetY(5);   // Untuk menyesuaikan gambar ke tengah secara vertikal
                $drawings[] = $drawing;
            }
        }

        return $drawings;
    }
}
