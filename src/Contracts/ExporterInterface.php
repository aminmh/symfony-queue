<?php

namespace App\Contracts;

interface ExporterInterface
{
    public function export(string $fileName, ExportableInterface $exportable): bool;
}
