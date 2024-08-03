FROM nginx:alpine

RUN rm /etc/nginx/conf.d/default.conf

COPY ./  /var/www/html/

COPY .docker/nginx/nginx.conf /etc/nginx/conf.d/config.conf

# Expose port 80
EXPOSE 80