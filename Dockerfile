# syntax = docker/dockerfile:1

FROM docker.io/alpine:latest as build

WORKDIR /app

ARG BASE_URL=''

RUN apk add --no-cache --repository=https://dl-cdn.alpinelinux.org/alpine/edge/community hugo

COPY . .

RUN hugo -b $BASE_URL

RUN echo "E404:404.html" > public/httpd.conf


# Final stage for app image
FROM docker.io/lipanski/docker-static-website:2.3.1

COPY --from=build /app/public .
