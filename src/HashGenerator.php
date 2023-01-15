<?php

namespace Bermuda\Hasher;

interface HashGenerator
{
    public function generateHash(string $input): string ;
}
