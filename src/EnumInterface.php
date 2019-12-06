<?php declare(strict_types=1);

namespace PhpType {

    use PhpType\Exception\TypeMismatchException;

    /**
     * Defines a common interface for enums.
     */
    interface EnumInterface
    {

        /**
         * String representation of the value.
         *
         * @return string
         */
        public function __toString(): string;

        /**
         * Compares the current enum with a given one.
         *
         * @param Enum $type
         *   An enum to compare the current one to.
         *
         * @return int
         *   Returns -1 if the current enum is precedes the given type, 0 if both types are equal and 1 if the current
         *   type follows the given type.
         *
         * @throws TypeMismatchException
         *   If the type of the current and provided enums are different.
         */
        public function compareTo(Enum $type): int;

        /**
         * Checks if the given enum equals with the current one.
         *
         * @param Enum $enum
         *   An enum to compare the current one to.
         *
         * @return bool
         *   True if they are equal, false otherwise.
         *
         * @throws TypeMismatchException
         *   If the type of the current and provided enums are different.
         */
        public function equals(Enum $enum): bool;

        /**
         * Gets the value of the enum without typecasting.
         *
         * @returns mixed
         *   The value with the original type.
         */
        public function getValue();
    }
}
