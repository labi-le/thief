<?php

declare(strict_types=1);

namespace labile\thief;

interface Command
{
    /**
     * Some command that can be run
     * @return mixed
     */
    public function execute();
}