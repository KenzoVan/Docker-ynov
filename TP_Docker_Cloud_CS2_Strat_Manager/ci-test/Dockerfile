FROM alpine:3.19

RUN apk add --no-cache bash curl

WORKDIR /ci
COPY run-tests.sh /ci/
RUN chmod +x /ci/run-tests.sh

CMD ["/bin/bash", "/ci/run-tests.sh"]
