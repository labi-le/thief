<?php
declare(strict_types=1);

namespace labile\thief\tests\unit;


class JugglerTest extends TestCase
{
    protected function setUp(): void
    {
        if (!getenv('THIEF_BOT_TOKEN_TEST')) {
            $this->markTestSkipped('THIEF_BOT_TOKEN_TEST is not set, skip...');
        }
    }

    public function testSetWebhook()
    {
        static::testDeleteWebhook();

        $this->assertTrue($this->juggler()
            ->setWebhook('https://labile.cc'));
    }

    public function testDeleteWebhook()
    {
        $this->assertTrue($this->juggler()
            ->deleteWebhook());
    }

    public function testWebhookInfo()
    {
        $this->assertNotEmpty($this->juggler()
            ->webhookInfo());
    }

}
