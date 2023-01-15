<?php

namespace Bermuda\Hasher;

interface HashValidator
{
    public function validateHash(string $input, string $hash): bool ;
}
