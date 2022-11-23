FROM nginx:1.23-alpine

COPY ./images/nginx/configs/nginx.dev.conf /etc/nginx/conf.d/default.conf

ARG NGINX_SERVER

RUN sed -i 's#{{NGINX_SERVER}}#'$NGINX_SERVER'#g' /etc/nginx/conf.d/default.conf

COPY ./ /var/www/html