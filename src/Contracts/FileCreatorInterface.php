<?php

namespace App\Contracts;

interface FileCreatorInterface
{
    public function touch(string $fileName): string;
}
