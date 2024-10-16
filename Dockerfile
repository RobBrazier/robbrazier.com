# syntax = docker/dockerfile:1

FROM docker.io/alpine:latest as build

RUN apk add --no-cache --repository=https://dl-cdn.alpinelinux.org/alpine/edge/community hugo

WORKDIR /app

COPY . .

ARG BASE_URL='/'

RUN hugo -b $BASE_URL

# Final stage for app image
FROM docker.io/joseluisq/static-web-server:2

COPY --from=build /app/public /public
