<?php declare(strict_types=1);

namespace PhpType {

    use PhpType\Exception\TypeMismatchException;
    use ReflectionClass;
    use ReflectionMethod;

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
        public function compareTo(EnumInterface $enum): int
        {
            $this->checkType($enum);
            return $this->value <=> $enum->value;
        }

        /**
         * {@inheritDoc}
         */
        public function equals(EnumInterface $enum): bool
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
         * {@inheritdoc}
         */
        public static function listValues(bool $as_object = true, array $ignore_enums = []): array
        {
            $enums = [];
            $ignore_enums_keyed = array_flip($ignore_enums);
            $class = new ReflectionClass(static::class);
            $methods = $class->getMethods(ReflectionMethod::IS_STATIC);

            foreach ($methods as $method) {
                if ($method->class !== Enum::class && !isset($ignore_enums_keyed[$method->name])) {
                    /** @var EnumInterface $enum */
                    $enum = static::{$method->name}();
                    $enums[$method->name] = $as_object ? $enum : $enum->getValue();
                }
            }

            return $enums;
        }

        /**
         * Checks the current object's and the given objects type.
         *
         * @param EnumInterface $enum
         *   An enum object to check.
         *
         * @throws TypeMismatchException
         *   If the type of the current and provided enums are different.
         */
        private function checkType(EnumInterface $enum): void
        {
            $class = get_class($enum);
            if (static::class !== $class) {
                throw new TypeMismatchException(strtr('The current object (:type_a) does not match with the given object (:type_b).', [
                    ':type_a' => static::class,
                    ':type_b' => $class,
                ]));
            }
        }
    }
}
