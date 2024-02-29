# thief

discord bot, created to accumulate user profiles

### Build

- Create a .env.prod file and fill it in (example in .env.example)

```sh 
cp .env.example .env.prod
```

- Create sqlite db

```sh
cp example.db db
```

- Build image

```sh
docker-сompose build --no-cache
```

- Up containers

```sh
docker-сompose up -d
```

### Easy way
```sh
git pull && docker-compose build --no-cache && docker-compose down && docker-compose up -d
```
