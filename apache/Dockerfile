FROM php:5.6-apache

MAINTAINER Michael Lopez <michael@weahead.se>

# Use Mac OS X default UID - via dinghy NFD mount
RUN usermod -u 501 www-data

# PHP base image chowns these folders for www-data
# since we changed uid for www-data we have to chown them again.
RUN chown -R www-data:www-data /var/lock/apache2 /var/run/apache2 /var/log/apache2 /var/www/html

RUN a2enmod rewrite expires

# install the PHP extensions we need
RUN apt-get update && apt-get install -y libpng12-dev libjpeg-dev && rm -rf /var/lib/apt/lists/* \
	&& docker-php-ext-configure gd --with-png-dir=/usr --with-jpeg-dir=/usr \
	&& docker-php-ext-install gd mysqli

ENV WORDPRESS_VERSION 4.5.2
ENV WORDPRESS_SHA1 bab94003a5d2285f6ae76407e7b1bbb75382c36e
ENV TARGET_DIR /var/www/html
ENV WORDPRESS_DEST ${TARGET_DIR}/wordpress
ENV WORDPRESS_CONTENT ${TARGET_DIR}/wp-content
ENV WORDPRESS_UPLOADS ${TARGET_DIR}/wp-uploads

# upstream tarballs include ./wordpress/ so this gives us /usr/src/wordpress
RUN curl -o wordpress.tar.gz -SL https://wordpress.org/wordpress-${WORDPRESS_VERSION}.tar.gz \
	&& echo "$WORDPRESS_SHA1 *wordpress.tar.gz" | sha1sum -c - \
	&& tar -xzf wordpress.tar.gz -C /usr/src/ \
	&& rm wordpress.tar.gz \
	&& chown -R www-data:www-data /usr/src/wordpress

RUN mkdir -p ${WORDPRESS_DEST} && mkdir -p ${WORDPRESS_UPLOADS}

COPY docker-entrypoint.sh /entrypoint.sh

COPY wp-content ${WORDPRESS_CONTENT}

COPY .htaccess wp-config.php ${TARGET_DIR}/

RUN chown -R www-data:www-data ${TARGET_DIR}

VOLUME ${WORDPRESS_CONTENT}

VOLUME ${WORDPRESS_UPLOADS}

# grr, ENTRYPOINT resets CMD now
ENTRYPOINT ["/entrypoint.sh"]
CMD ["apache2-foreground"]
