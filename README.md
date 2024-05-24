# thief

yet another telegram bot framework

### why I decided to create a special library?
#### I couldn't find a suitable solution that solved my assigned problem

inspired by [php-telegram-bot](https://github.com/php-telegram-bot/core) \
I originally just wanted to extend it because I needed features that this package doesn't support. The extension happened so horribly - that's why I created thief

### thanks to these packages for code that I can not rewrite, but simply reuse the necessary components
- [TelegramBot/Api](https://github.com/TelegramBot/Api) | [License](https://github.com/TelegramBot/Api/blob/master/LICENSE.md)
- [php-telegram-bot](https://github.com/php-telegram-bot/core) | [License](https://github.com/php-telegram-bot/core/blob/develop/LICENSE)

### goals
one of the main goals is to make the framework as extensible as possible

### todo
- [x] add command storage
- [x] webhook manager
- [ ] handle updates
- [ ] handle commands
- [ ] add attributes
- [ ] add middleware
- [ ] add dto tg responses
- [ ] add client wrapper (basically tg methods, sendMessage, ...)
- [ ] add ci cd, test, cs fixer, ...