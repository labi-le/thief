test:
	./vendor/bin/phpunit --testdox --colors

develop-server:
	XDEBUG_CONFIG=idekey=PHPSTORM \
	discover_client_host=1 \
	discover_client_host=192.168.1.3 \
	XDEBUG_MODE=debug \
	php -S 0.0.0.0:8080 -t examples