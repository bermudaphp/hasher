<?php

namespace Bermuda\Hasher;

interface HashValidator
{
    public function needRehash(string $hash): bool ;
    public function validateHash(string $input, string $hash): bool ;
}
