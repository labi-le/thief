CONTOUR = dev

include .env.$(CONTOUR)
export $(shell sed 's/=.*//' .env.$(CONTOUR))

PROJ_NAME = thief

MAIN_PATH = cmd/main.go
BUILD_PATH = build/package/

.DEFAULT_GOAL := run

run:
	go run $(MAIN_PATH)

build: clean
	go build --ldflags '-extldflags "-static"' -v -o $(BUILD_PATH)$(PROJ_NAME) $(MAIN_PATH)

clean:
	rm -rf $(BUILD_PATH)*

tests:
	go test ./...

lint:
	golangci-lint run

migrate-up:install-migrate-tool
	./migrate -path ./migrations -database sqlite3://$(DB_NAME) up

migrate-create:install-migrate-tool
	./migrate create -ext sql -dir ./migrations $(filter-out $@,$(MAKECMDGOALS))

install-migrate-tool:
	@[ -f ./migrate ] \
		|| curl -L https://github.com/golang-migrate/migrate/releases/download/v4.15.2/migrate.linux-amd64.tar.gz \
		| tar zxvf - migrate

cloc:
	cloc . --exclude-ext=yml,mod,sum,xml