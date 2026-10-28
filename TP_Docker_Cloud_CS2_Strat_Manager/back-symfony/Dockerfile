FROM alpine:3.19

# Installation de PHP 8.2 et des extensions Symfony nécessaires
RUN apk add --no-cache php82 php82-cli php82-pdo php82-mbstring php82-openssl php82-pcntl netcat-openbsd

# Création d'un utilisateur non-root pour des raisons de sécurité
RUN adduser -D symfonyuser
WORKDIR /var/www/html

COPY index.php /var/www/html/index.php
RUN chown -R symfonyuser:symfonyuser /var/www/html

USER symfonyuser

EXPOSE 8000

# Entrypoint sous forme JSON pour capter directement le SIGTERM (PID 1)
CMD ["php82", "index.php"]
