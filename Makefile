# server

server-start: _server_start
server-stop: _server_stop

_server_start:
	./bin/console server:start
_server_stop:
	./bin/console server:stop

# bundle

bundle: _bundle

_bundle:
	./bin/console generate:bundle --namespace=UserInterface/${name} --bundle-name=${name} --dir=src --format=yml --no-interaction

#docker

dm: _dm
pow: _pow

_dm:
	 eval "$(docker-machine env demo)"
_pow:
	echo "http://192.168.99.100:80" > ~/.pow/demo