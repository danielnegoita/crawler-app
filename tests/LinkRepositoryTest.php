<?php

namespace Tests;

use App\Domain\Url;
use App\Domain\Model\Link;
use PHPUnit\Framework\TestCase;
use App\Infrastructure\LinkRepository;
use App\Infrastructure\StorageAdaptorInterface;

class LinkRepositoryTest extends TestCase
{
    public function testCanSaveLinks()
    {
        $link = Link::create(
            Url::fromString('http://test.com'),
            'http://example.com'
        );

        $fakeStorageAdaptor = $this->createMock(StorageAdaptorInterface::class);
        $fakeStorageAdaptor->method('saveLinks')
            ->willReturn(true);

        $linkRepository = new LinkRepository($fakeStorageAdaptor);
        $linkRepository->persist($link);

        $this->assertEquals(true, $linkRepository->save());
    }
}