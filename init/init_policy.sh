#!/bin/bash
for model in $(cat ./init/models.txt); do
    php artisan make:policy ${model}Policy -m ${model}
done

