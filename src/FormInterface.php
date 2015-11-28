<?php

namespace Bootstrapper;

interface FormInterface
{
    /**
     * @param string $field The field to test
     * @return bool
     */
    public function hasErrors($field);

    /**
     * @param string $field The field to get the error for
     * @return string
     */
    public function getFormattedError($field);

    /**
     * @param string $type The type of form element to create
     * @param array  $args The arguments needed to create that element
     * @return string
     */
    public function create($type, array $args);
}
