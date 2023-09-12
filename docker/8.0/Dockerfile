FROM ubuntu:21.10

LABEL maintainer="Taylor Otwell"

ARG WWWGROUP
ARG NODE_VERSION=16

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y gnupg gosu curl ca-certificates zip unzip git supervisor sqlite3 libcap2-bin libpng-dev python2 \
    && mkdir -p ~/.gnupg \
    && chmod 600 ~/.gnupg \
    && apt-get update \
    && apt-get install -y php8.0-cli php8.0-dev \
       php8.0-pgsql php8.0-sqlite3 php8.0-gd \
       php8.0-curl php8.0-memcached \
       php8.0-imap php8.0-mysql php8.0-mbstring \
       php8.0-xml php8.0-zip php8.0-bcmath php8.0-soap \
       php8.0-intl php8.0-readline php8.0-pcov \
       php8.0-msgpack php8.0-igbinary php8.0-ldap \
       php8.0-redis php8.0-xdebug php8.0-sybase \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && curl -sL https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm \
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list \
    && apt-get update \
    && apt-get install -y yarn \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

### MSSQL SERVER CLI TOOLS ###
    RUN apt-get update \
        && apt-get install -y \
        apt-transport-https debconf-utils \
        && rm -rf /var/lib/apt/lists/*

    # adding custom MS repository
    RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add -
    RUN curl https://packages.microsoft.com/config/ubuntu/21.04/prod.list > /etc/apt/sources.list.d/mssql-release.list

    # install SQL Server drivers and tools
    RUN apt-get update && ACCEPT_EULA=Y apt-get install -y msodbcsql17 mssql-tools
    RUN echo 'export PATH="$PATH:/opt/mssql-tools/bin"' >> ~/.bashrc
    RUN /bin/bash -c "source ~/.bashrc"
### END MSSQL SERVER CLI TOOLS ###

RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8.0

RUN useradd sail
RUN usermod -a -G sail sail

COPY start-container /usr/local/bin/start-container
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY php.ini /etc/php/8.0/cli/conf.d/99-sail.ini
RUN chmod +x /usr/local/bin/start-container

EXPOSE 8000

ENTRYPOINT ["start-container"]
