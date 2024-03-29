<?php

namespace Bermuda\Hasher;

final class Hash implements \Stringable
{
    public function __construct(
      public readonly string $value, 
      public readonly HasherInterface $hasher = new PasswordHasher,
      public readonly ?string $rawValue = null
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
    
    public function needRehash(): bool
    {
        return $this->hasher->needRehash($this->value);
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
                : $staticHasher = new PasswordHasher ;
        } else {
            $staticHasher = $hasher;
        }

        return $staticHasher;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @param string $input
     * @return static
     */
    public static function fromString(string $input): self
    {
        return new static(($hasher = static::hasher())->generateHash($input), $hasher, $input);
    }
}
