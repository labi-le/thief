<?php

namespace labile\thief;

interface WebhookManipulator
{
    public function setWebhook(string $url, array $options = []): bool;

    public function deleteWebhook(bool $dropPendingUpdates = false): bool;

    public function webhookInfo(): array;
}