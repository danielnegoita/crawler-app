<?php

namespace App\Repository;

interface IssueRepositoryInterface
{
    public function getAllIssues(): ?array;
}