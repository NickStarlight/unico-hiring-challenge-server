# Unico Hiring Challenge - Server module
![PHP Version](https://img.shields.io/badge/PHP%20Version-8.0-informational)
![Coding Style](https://img.shields.io/badge/Coding%20Style-PSR--12-yellow)
[![Code Quality](https://img.shields.io/badge/Code%20Quality-A-green)](https://github.com/NickStarlight/unico-hiring-challenge-server/actions/workflows/Quality.yaml)
![Psalm Static Analysis](https://github.com/NickStarlight/unico-hiring-challenge-server/actions/workflows/Quality.yaml/badge.svg)
![Test and coverage](https://github.com/NickStarlight/unico-hiring-challenge-server/actions/workflows/Tests.yaml/badge.svg)
[![codecov](https://codecov.io/gh/NickStarlight/unico-hiring-challenge-server/branch/master/graph/badge.svg?token=K2D4AEBB3D)](https://codecov.io/gh/NickStarlight/unico-hiring-challenge-server)
![License](https://img.shields.io/badge/License-CC%20BY--NC--SA%204.0-lightgrey.svg)

## About
This module contains the second half of the Unico Hiring Challenge that is described as following:

* Registration of a new fair
* Fair exclusion via registration code
* Update the registered fields of a fair, except registration code
* Search for fairs using at least one of the parameters:
    * district
    * region5
    * fair_name 
    * neighborhood

## Requeriments
* PHP 8.0
* Composer
* Docker
* The ETL part of the project for seeding fair data.

## Usage

1. Install Composer dependencies

```bash
composer install
```

2. Create your .env file, the defaults will work fine.

```bash
cp .env.example .env
```

3. Start the Laravel Sail container
```bash
./vendor/bin/sail up -d
```

4. Run the migrations
```bash
./vendor/bin/sail artisan migrate
```

5. Run the ETL script from the ETL counterpart of this project

6. You're good to go!

## API Documentation
All documentation and use examples can be found on the OpenFair Postman documentation page.

[![Run in Postman](https://run.pstmn.io/button.svg)](https://documenter.getpostman.com/view/16582890/Tzm6kFoA)

## Database taxonomy

#### Tables
| OpenFair  | Original file |
|---|---|
|  Borough  |  Subprefeitura |
| Census Area  |  Area de Pondera????o |
| Census Sector | Setor Censit??ro  |
| District | Distrito  |
| Fair | Feira Livre  |

#### Attributes
Listed only attributes that do not translate directly from the original.
| OpenFair  | Original file |
|---|---|
|  pmsp_code  |  REGISTRO |
| smdu_code  |  CODSUBPREF |
| octave_region_name | REGIAO8  |
| quinary_region_name | REGIAO5  |

## Logging
Errors are automatically logged to `storage/logs/laravel.log`.

## Testing
This repository offer two types of tests, Unit and Feature.

Unit tests focus on testing specific functions while Feature tests focus on testing HTTP endpoints and it's responses.

For running all the tests, use the built-in Laravel Sail CLI with the Artisan test command:

```bash
./vendor/bin/sail artisan test
```

If you wan't coverage reports to be also generated, use:

```bash
./vendor/bin/sail artisan test --coverage-html reports
```

## License
This work is licensed under a
[Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License][cc-by-nc-sa].

[![CC BY-NC-SA 4.0][cc-by-nc-sa-image]][cc-by-nc-sa]

[cc-by-nc-sa]: http://creativecommons.org/licenses/by-nc-sa/4.0/
[cc-by-nc-sa-image]: https://licensebuttons.net/l/by-nc-sa/4.0/88x31.png
[cc-by-nc-sa-shield]: https://img.shields.io/badge/License-CC%20BY--NC--SA%204.0-lightgrey.svg
