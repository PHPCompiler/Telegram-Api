<?php

namespace PhpCompiler\Telegram\Tools;

class Response
{
    /**
     * @param bool $success
     * @param int $errorCode
     * @param string $description
     * @param mixed $result
     * @param int $resultCount
     */
    public function __construct(
        private bool   $success,
        private int    $errorCode,
        private string $description,
        private mixed  $result,
        private int    $resultCount,
    ) {

    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getResult(): mixed
    {
        return $this->result;
    }

    public function getResultCount(): int
    {
        return $this->resultCount;
    }
}