
FROM thecodingmachine/php:7.2-v2-apache

RUN sudo apt-get update \
    && sudo apt-get install -y \
        curl \
        libxrender1 \
        libfontconfig \
        libxtst6 \
        xz-utils \
        libssl1.0-dev

RUN curl "https://downloads.wkhtmltopdf.org/0.12/0.12.4/wkhtmltox-0.12.4_linux-generic-amd64.tar.xz" -L -o "wkhtmltopdf.tar.xz"
RUN tar Jxvf wkhtmltopdf.tar.xz
RUN sudo mv wkhtmltox/bin/wkhtmltopdf /usr/local/bin/wkhtmltopdf
RUN sudo chmod +x /usr/local/bin/wkhtmltopdf
