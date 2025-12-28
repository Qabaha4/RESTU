FROM ubuntu:22.04
ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && \
    apt-get install -y apache2 php libapache2-mod-php php-mysql && \
    rm -f /var/www/html/index.html

COPY site/ /var/www/html/

EXPOSE 80
CMD ["apachectl", "-D", "FOREGROUND"]
