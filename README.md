# Task Manager
[![Actions Status](https://github.com/occulo/php-project-57/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/occulo/php-project-57/actions) [![PHP CI](https://github.com/occulo/php-project-57/actions/workflows/ci.yml/badge.svg)](https://github.com/occulo/php-project-57/actions/workflows/ci.yml) [![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=occulo_php-project-57&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=occulo_php-project-57)

## Description
Task Manager is a Laravel-based application designed to provide a streamlined workflow for organizing and tracking tasks with statuses, labels, and assignments. It supports task creation, updates, and filtering.

## Prerequisites
* Linux, MacOS, WSL
* PHP >= 8.3
* Composer >= 2.0
* Node.js >= 18
* Git
* Make

## Installation
### Source
Clone the repository to your machine:
```bash
git clone https://github.com/occulo/php-project-57.git
cd php-project-57
```
Install dependencies and set up the project:
```bash
make install
```
This will also initialize the environment and build frontend assets. No manual `.env` configuration is required for local development.

## Running
### Local
Start the application:
```bash
make start
```
The application will be available at `http://localhost:8000`.

## Authentication
After setup, the database is seeded with test data.

You can either register a new account via the UI, or log in using seeded credentials:
- **Email:** `test@example.com`
- **Password:** `password`

## Makefile overview
| Command              | Description                |
|----------------------|----------------------------|
| `make install`       | Set up project             |
| `make start`         | Start local server         |
| `make test`          | Run PHPUnit tests          |
| `make test-coverage` | Generate coverage report   |
| `make lint`          | Run PHP CodeSniffer        |
| `make lint-fix`      | Fix coding style issues    |

See full implementation in [Makefile](./Makefile)

## Demo
A live demo of this application is available at: https://php-project-57-juh1.onrender.com/