# thief

дискорд-бот, создан аккумуляции анкет пользователей

### Как это собрать

- Создать файл .env.prod и заполнить его (пример в .env.example

```sh 
cp .env.example .env.prod
```

- Создать sqlite базу данных

```sh
cp example.db db
```

- Собрать образ

```sh
docker-сompose build --no-cache
```

- Запустить контейнеры

```sh
docker-сompose up -d
```