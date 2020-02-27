FROM node:10-stretch-slim

ARG APP_DIR="/usr/src/app"

WORKDIR $APP_DIR

ADD . .

RUN npm install && \
    npm run build

EXPOSE 80

CMD [ "npm", "run", "serve" ]