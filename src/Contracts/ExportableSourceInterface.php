<?php

namespace App\Contracts;

interface ExportableSourceInterface
{
    public function get(): array;
}
