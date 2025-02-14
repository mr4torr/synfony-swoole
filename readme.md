## Referencias

* Para instalação do swoole utilizei [esse pacote](https://github.com/php-runtime/swoole)

<p align="center">
  <img src="./public/assets/bench.jpg" width="350" title="benchmark">
</p>

Rodar ambiente

```sh
make start
```

Acessar container `app`
```sh
docker exec -it symfony-swoole-php-app-1 bash
```

Execute o seeds
```sh
php bin/console doctrine:fixtures:load
```