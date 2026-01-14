FROM ghcr.io/gohugoio/hugo:v0.154.5 AS hugo

ARG BASE_URL=""

WORKDIR /app

COPY --chown=1000:1000 . /app

RUN hugo build -b "$BASE_URL"

FROM cgr.dev/chainguard/nginx:latest

COPY --from=hugo --chown=65532:65532 /app/public /usr/share/nginx/html
