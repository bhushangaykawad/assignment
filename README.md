# Assignment

## Follow these steps

- Clone repository using following command ```git clone https://github.com/bhushangaykawad/assignment.git```
- access project folder using ```cd assignment```
- run ```composer install```

## Now application is ready to use

run ```php artisan ee:salarydates filename```

It will generate new csv file in ```assignment\storage\app\public```

Note: If you want output file in public folder then run ```php artisan storage:link```
This will create symlink of storage folder in public folder
