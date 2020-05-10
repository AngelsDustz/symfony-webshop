FROM bitnami/symfony:1
RUN apt update
RUN apt install -y nodejs npm
RUN npm i -g yarn