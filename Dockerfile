# syntax = docker/dockerfile:1

FROM docker.io/alpine:latest as build

WORKDIR /app

ARG BASE_URL=''

RUN apk add --no-cache --repository=https://dl-cdn.alpinelinux.org/alpine/edge/community hugo

COPY . .

RUN hugo -b $BASE_URL


# Final stage for app image
FROM docker.io/pierrezemb/gostatic:latest

COPY --from=build /app/public /srv/http

CMD ["-enable-logging"]
