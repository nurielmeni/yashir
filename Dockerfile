FROM wordpress:latest
LABEL maintainer Nuriel Meni <nurielmeni@gmail.com>

ENV XDEBUG_PORT 9005
ENV XDEBUG_IDEKEY docker

RUN apt-get update && apt-get install -y libxml2 libxml2-dev

# Install PHP Soap Extention
RUN docker-php-ext-install soap

# Install Xdebug
RUN pecl install "xdebug-2.9.3" \
    && docker-php-ext-enable xdebug

# XDEBUG 2.9.3
RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_autostart=1" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_port=${XDEBUG_PORT}" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.idekey=${XDEBUG_IDEKEY}" >> /usr/local/etc/php/conf.d/xdebug.ini && \
    echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini

# XDEBUG 3
# RUN echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/xdebug.ini && \
#     echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/xdebug.ini && \
#     echo "xdebug.remote_port=${XDEBUG_PORT}" >> /usr/local/etc/php/conf.d/xdebug.ini && \
#     echo "xdebug.idekey=${XDEBUG_IDEKEY}" >> /usr/local/etc/php/conf.d/xdebug.ini && \
#     echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/xdebug.ini


#COPY ./alut /vaw/wwW/html/wp-content/plugins/NlsHunterApi
