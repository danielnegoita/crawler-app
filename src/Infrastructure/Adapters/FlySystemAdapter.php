<?php

namespace App\Infrastructure\Adapters;

use App\Domain\File;
use League\Flysystem\Filesystem;
use League\Flysystem\UnableToWriteFile;
use League\Flysystem\FilesystemException;
use League\Flysystem\Local\LocalFilesystemAdapter;
use App\Infrastructure\FileSystemAdapterInterface;
use App\Application\Exceptions\UnableToSaveFileException;

class FlySystemAdapter implements FileSystemAdapterInterface
{
    private Filesystem $filesystem;

    public function __construct()
    {
        // TODO: move root path to .env
        $adapter = new LocalFilesystemAdapter(dirname(__DIR__, 3));

        $this->filesystem = new Filesystem($adapter);
    }

    /**
     * @param File $file
     * @return bool
     * @throws UnableToSaveFileException
     */
    public function saveFile(File $file): bool
    {
        try {
            $this->filesystem->write($file->path(), $file->content());
            return true;
        } catch (FilesystemException | UnableToWriteFile $exception) {
            throw new UnableToSaveFileException($exception);
        }
    }
}