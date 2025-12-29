FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
git \
unzip \
&& rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /api

# Install Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony

CMD ["bash"]