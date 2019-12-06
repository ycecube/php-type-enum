<?php declare(strict_types=1);

namespace PhpType {

    use PhpType\Exception\TypeMismatchException;

    /**
     * Defines a base type for "enum" values.
     */
    abstract class Enum implements EnumInterface
    {

        /** @var mixed */
        private $value;

        /**
         * Constructs the type with a given value.
         *
         * @param mixed $value
         */
        protected function __construct($value)
        {
            $this->value = $value;
        }

        /**
         * {@inheritDoc}
         */
        public function __toString(): string
        {
            return (string) $this->value;
        }

        /**
         * {@inheritDoc}
         */
        public function compareTo(Enum $enum): int
        {
            $this->checkType($enum);
            return $this->value <=> $enum->value;
        }

        /**
         * {@inheritDoc}
         */
        public function equals(Enum $enum): bool
        {
            $this->checkType($enum);
            return $this->value === $enum->value;
        }

        /**
         * {@inheritDoc}
         */
        public function getValue()
        {
            return $this->value;
        }

        /**
         * Checks the current object's and the given objects type.
         *
         * @param Enum $enum
         *   The enum object to check.
         * @throws TypeMismatchException
         *   If the type of the current and provided enums are different.
         */
        private function checkType(Enum $enum): void
        {
            $class = get_class($enum);
            if (static::class !== $class) {
                throw new TypeMismatchException(strtr('The given object does not match with the current one.', [
                    ':type_a' => static::class,
                    ':type_b' => $class,
                ]));
            }
        }
    }
}
