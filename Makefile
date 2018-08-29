PHPUNIT=./phpunit
PHPAB=./phpab

.PHONY: all tests

tests:
	-printf "\n*** Generating autoloader...\n\n"
	${PHPAB} \-o src/autoload.php composer.json
	${PHPUNIT} --bootstrap src/autoload.php tests

all: tests
