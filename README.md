[![run-tests](https://github.com/turahe/post/actions/workflows/run-test.yml/badge.svg)](https://github.com/turahe/post/actions/workflows/run-test.yml)

# Turahe Post


## Installation

1. Install the package via composer:

    ```shell
    composer require turahe/post
    ```

2. Publish resources (migrations and config files):

    ```shell
    php artisan vendor:publish --provider="Turahe\Core\PostServiceProvider"
    ```

3. Execute migrations via the following command:

    ```shell
    php artisan migrate
    ```

4. Done!


