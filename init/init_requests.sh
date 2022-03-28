#!/bin/bash
for model in $(cat ./init/models.txt); do
    php artisan make:request Store${model}Request
    php artisan make:request Update${model}Request
done