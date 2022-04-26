# Symfony Docker Drone Env Vars App

This app is showing **Environment Variables** using the **printenv** command.

**OBVIOUSLY, DON'T USE THIS APP IN A PRODUCTION ENVIRONMENT! THIS IS ONLY FOR TESTING.**

I made this app to debug environment variables passed by DroneCI and Docker containers in a **Unix / Linux** environment.

## What you need ?

- Docker & docker-compose

## How to use ?

- Clone this repo
- Run the following command depending on your goal:
  - Locally : `docker-compose -f docker-compose.yml -f docker-compose.local.yml up -d --build --force-recreate`
  - Using [caddy-docker-proxy](https://github.com/lucaslorentz/caddy-docker-proxy) : `docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d --build --force-recreate`
- Go to `http://localhost:8080`
- Admire your environment variables

## Define your environment variable

### Using the `.env` file

Define a variable in the `.env` file like so :

```bash
MY_ENV_VAR=myEnvVar
```