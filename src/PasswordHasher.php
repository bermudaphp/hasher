<?php

namespace Bermuda\Hasher;

final class PasswordHasher implements HasherInterface
{
    public function __construct(
        public readonly string $algorithm = PASSWORD_ARGON2ID,
        public readonly array $options = []
    ) {
        if (!in_array($this->algorithm, password_algos())) {
            throw new \InvalidArgumentException(
                "Invalid algorithm: [ $this->algorithm ]. Supported algorithms: "
                . join(',', password_algos())
            );
        }
    }

    /**
     * @inerhitDoc
     */
    public function generateHash(string $input): string
    {
        return password_hash($input, $this->algorithm, $this->options);
    }

    /**
     * @inerhitDoc
     */
    public function validateHash(string $input, string $hash): bool
    {
        return password_verify($input, $hash);
    }
  
    /**
     * @inerhitDoc
     */
    public function needRehash(string $hash): bool
    {
        return password_needs_rehash($hash, $this->algorithm, $this->options);
    }
}
