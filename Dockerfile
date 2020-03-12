FROM node:10-stretch-slim as builder

ARG APP_DIR="/usr/src/app"

WORKDIR $APP_DIR

COPY . .

RUN npm install && \
    npm run build

FROM nginx:alpine

COPY .nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf
COPY --from=builder /usr/src/app/public /var/www