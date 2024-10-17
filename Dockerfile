# syntax = docker/dockerfile:1

FROM docker.io/alpine:latest AS build

RUN apk add --no-cache --repository=https://dl-cdn.alpinelinux.org/alpine/edge/community hugo

WORKDIR /app

COPY . .

RUN hugo

# Final stage for app image
FROM docker.io/joseluisq/static-web-server:2

COPY --from=build /app/public /public
