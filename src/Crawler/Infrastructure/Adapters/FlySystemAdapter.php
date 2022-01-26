<?php

namespace Crawler\Infrastructure\Adapters;

use Crawler\Domain\File;
use League\Flysystem\Filesystem;
use League\Flysystem\UnableToWriteFile;
use League\Flysystem\UnableToDeleteFile;
use League\Flysystem\FilesystemException;
use League\Flysystem\Local\LocalFilesystemAdapter;
use Crawler\Infrastructure\FileSystemAdapterInterface;
use Crawler\Infrastructure\Exceptions\UnableToSaveFileException;
use Crawler\Infrastructure\Exceptions\UnableToDeleteFileException;

class FlySystemAdapter implements FileSystemAdapterInterface
{
    private Filesystem $filesystem;

    public function __construct()
    {
        // TODO: move root path to .env
        $adapter = new LocalFilesystemAdapter(dirname(__DIR__, 4));

        $this->filesystem = new Filesystem($adapter);
    }

    /**
     * @param File $file
     * @return bool
     * @throws UnableToSaveFileException
     */
    public function saveFile(File $file): void
    {
        try {
            $this->filesystem->write($file->path(), $file->content());
        } catch (FilesystemException | UnableToWriteFile $exception) {
            throw new UnableToSaveFileException($exception);
        }
    }

    /**
     * @param string $path
     * @throws UnableToDeleteFileException
     */
    public function deleteFile(string $path): void
    {
        try {
            $this->filesystem->delete($path);
        } catch (FilesystemException | UnableToDeleteFile $exception) {
            throw new UnableToDeleteFileException($exception);
        }
    }
}