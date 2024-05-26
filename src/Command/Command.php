<?php

declare(strict_types=1);

namespace labile\thief\Command;

use labile\thief\Pattern\Pattern;
use labile\thief\Response;

interface Command
{
    /**
     * Some command that can be run
     * @return Response
     */
    public function execute(): Response;

    /**
     * Фильтр команды
     */
    public function pattern(): Pattern;

    /**
     * @return string
     */
    public function description(): string;
}