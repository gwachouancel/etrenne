# docker run --init -it --rm -v "${PWD}:/project" -w /project  jakzal/phpqa phpstan analyse .
# DOC https://bestofphp.com/repo/nunomaduro-larastan-php-miscellaneous

./vendor/bin/phpstan analyse app --memory-limit=1G