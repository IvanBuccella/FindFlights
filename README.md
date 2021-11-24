# FindFlights

This is a PHP software that finds available flights assuming at most 2 stopovers.

## Project Guidelines

### Database Structure

TAB1 - airport
```
- id
- name
- code
- lat
- lng
```

TAB2 - flight
```
- code_departure
- code_arrival
- price
```

### Challenge

Try to create a PHP algorith that finds the lowest price, given two different airport's code in TAB1, assuming at most 2 stopovers! 
At the end, represent it in a working landing page.

## Tutorial Structure

- **[Installation](#installation)**
  - **[Prerequisites](#prerequisites)**
  - **[Repository](#repository)**
  - **[Environment Variables](#environment-variables)**
  - **[Build](#build)**
  - **[Run Docker Services](#run-docker-services)**

## Installation

### Prerequisites

- Docker and Docker Compose (Application containers engine). Install it from here https://www.docker.com

### Repository

Clone the repository:

```sh
$ git clone https://github.com/IvanBuccella/FindFlights
```

### Environment Variables

Set your own environment variables by using the `.env-sample` file.

### Build

Build the local environment with Docker:

```sh
$ docker-compose build
```

### Run Docker Services

```sh
$ docker-compose up
```

### Enjoy :-)

You can use the application by visiting the `http://localhost:${APP_PORT}` URL.
