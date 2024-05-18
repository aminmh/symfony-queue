<?php

namespace App\Services;

use App\Contracts\FileCreatorInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\HttpKernel\KernelInterface;

class FileCreatorService implements FileCreatorInterface
{

    public function __construct(private readonly KernelInterface $kernel, private readonly string $exportPath)
    {

    }

    public function touch(string $fileName): string
    {
        $exportPathDirectory = Path::makeAbsolute($this->exportPath, $this->getProjectDir());
        if (is_dir($exportPathDirectory) === false) {
            throw new \RuntimeException(sprintf('%s is not directory!', $this->exportPath));
        }

        $path = sprintf('%s/%s', $exportPathDirectory, $fileName);
        $fileSystem = new Filesystem();
        $fileSystem->touch($path);

        return $path;
    }

    private function getProjectDir(): string
    {
        return $this->kernel->getProjectDir();
    }
}
