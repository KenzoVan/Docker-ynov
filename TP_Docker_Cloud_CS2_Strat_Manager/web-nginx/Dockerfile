FROM alpine:3.19

# Installation et configuration minimale de Nginx
RUN apk add --no-cache nginx &&     mkdir -p /run/nginx

COPY default.conf /etc/nginx/http.d/default.conf

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
