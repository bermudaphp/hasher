<?php

namespace Bermuda\Hasher;

class Hash implements \Stringable
{
    public function __construct(
      public readonly string $value, 
      private readonly HasherInterface $hasher = new Hasher
    ) {
    }

    /**
     * @param string $input
     * @return bool
     */
    public function validate(string $input): bool
    {
        return $this->hasher->validateHash($input, $this->value);
    }

    /**
     * @param HasherInterface|null $hasher
     * @return HasherInterface
     */
    public static function hasher(HasherInterface $hasher = null): HasherInterface
    {
        static $staticHasher = null;

        if ($hasher == null) {
            return $staticHasher != null ? $staticHasher
                : $staticHasher = new Hasher ;
        } else {
            $staticHasher = $hasher;
        }

        return $staticHasher;
    }

    /**
     * @param string $hash
     * @return static
     */
    public static function create(string $hash): self
    {
        return new static($hash, static::hasher());
    }

    /**
     * @param string $input
     * @return static
     */
    public static function createFromString(string $input): self
    {
        return new static(($hasher = static::hasher())->generateHash($input), $hasher);
    }
}
