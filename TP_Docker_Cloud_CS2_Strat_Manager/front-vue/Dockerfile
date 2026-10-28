FROM alpine:3.19

# Installation des dépendances pour VueJS
RUN apk add --no-cache nodejs npm

WORKDIR /app
COPY index.html /app/index.html

EXPOSE 3000

CMD ["node", "-e", "console.log('Frontend VueJS prêt pour CS2 Strat Manager sur le port 3000')"]
