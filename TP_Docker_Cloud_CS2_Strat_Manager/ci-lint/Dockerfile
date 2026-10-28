FROM alpine:3.19

RUN apk add --no-cache bash

WORKDIR /ci
COPY run-lint.sh /ci/
RUN chmod +x /ci/run-lint.sh

CMD ["/bin/bash", "/ci/run-lint.sh"]
