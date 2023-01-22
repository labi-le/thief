FROM golang:1.19 as modules

ADD go.mod go.sum /m/
RUN cd /m && go mod download

FROM golang:1.19 as builder

COPY --from=modules /go/pkg /go/pkg

RUN mkdir -p /app
COPY . /app
WORKDIR /app

RUN go build --ldflags '-extldflags "-static"' -o thief cmd/main.go

FROM busybox

RUN mkdir -p /built
WORKDIR /built

COPY --from=builder /app/thief /built/thief
COPY --from=builder /etc/ssl/certs/ca-certificates.crt /etc/ssl/certs/

ENTRYPOINT [ "./thief" ]