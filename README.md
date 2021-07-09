# Unico Hiring Challenge - Server module
![PHP Version](https://img.shields.io/badge/PHP%20Version-8.0-informational)
![Coding Style](https://img.shields.io/badge/Coding%20Style-PSR--12-yellow)
[![Code Quality](https://img.shields.io/badge/Code%20Quality-A%2B-green)](https://github.com/NickStarlight/unico-hiring-challenge-etl/actions/workflows/Quality.yaml)
![Psalm Static Analysis](https://github.com/NickStarlight/unico-hiring-challenge-etl/actions/workflows/Psalm.yaml/badge.svg)
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
* Docker
* The ETL part of the project for seeding fair data.

## Usage

1. Build the Docker image:

```bash
docker build -t unico/fair-server .
```

## Logging
Errors are automatically logged to `storage/logs/laravel.log`.

## Database structure
![UML](https://i.imgur.com/ybOpylH.png)


## Testing
This repository offers no unit/integration tests due time constraints.

## License
This work is licensed under a
[Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License][cc-by-nc-sa].

[![CC BY-NC-SA 4.0][cc-by-nc-sa-image]][cc-by-nc-sa]

[cc-by-nc-sa]: http://creativecommons.org/licenses/by-nc-sa/4.0/
[cc-by-nc-sa-image]: https://licensebuttons.net/l/by-nc-sa/4.0/88x31.png
[cc-by-nc-sa-shield]: https://img.shields.io/badge/License-CC%20BY--NC--SA%204.0-lightgrey.svg
