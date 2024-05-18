<?php

namespace App\Services;

use App\Contracts\ExportableInterface;
use App\Contracts\ExporterInterface;
use App\Contracts\FileCreatorInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\IWriter;

readonly class SheetCreatorService implements ExporterInterface
{
    public function __construct(private FileCreatorInterface $fileCreator)
    {

    }

    public function export(string $fileName, ExportableInterface|\Sheet $exportable): bool
    {
        $fileName = $this->fileCreator->touch($fileName);
        $spreadsheet = $this->createNewSpreadsheet();
        $this->fillSpreadsheet($spreadsheet, [$exportable->getHeaders(), ...$exportable->getData()]);
        $writer = $this->createWriter($spreadsheet);
        $writer->save($fileName);
        $this->freeSpreadsheetFromMemory($spreadsheet);

        return file_exists($fileName);
    }

    private function createNewSpreadsheet(): \PhpOffice\PhpSpreadsheet\Spreadsheet
    {
        return new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    }

    private function fillSpreadsheet(Spreadsheet $spreadsheet, array $data): void
    {
        $spreadsheet->getActiveSheet()->fromArray(
            $data
        );
    }

    private function createWriter(Spreadsheet $spreadsheet): IWriter
    {
        return new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    }

    private function freeSpreadsheetFromMemory(Spreadsheet $spreadsheet): void
    {
        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
    }
}
