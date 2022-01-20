<?php

namespace Tests;

use Crawler\Domain\Url;
use Crawler\Domain\Model\Link;
use PHPUnit\Framework\TestCase;
use Crawler\Infrastructure\LinkRepository;
use Crawler\Infrastructure\StorageAdaptorInterface;

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