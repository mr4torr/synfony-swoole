# POC

Performance study and microservices architecture model

```sh
# FPM
Running 5s test @ http://web:8080
  16 threads and 100 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency   384.29ms  146.43ms   1.03s    70.03%
    Req/Sec    16.69      9.41    50.00     70.62%
  Latency Distribution
     50%  405.82ms
     75%  471.94ms
     90%  550.46ms
     99%  742.11ms
  1213 requests in 5.09s, 273.64KB read
Requests/sec:    238.47
Transfer/sec:     53.79KB

# Swoole
Running 5s test @ http://web
  16 threads and 100 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency    16.06ms   11.32ms 102.24ms   79.29%
    Req/Sec   395.18     91.26   640.00     83.77%
  Latency Distribution
     50%   11.71ms
     75%   23.32ms
     90%   30.34ms
     99%   55.47ms
  31784 requests in 5.10s, 7.58MB read
Requests/sec:   6237.39
Transfer/sec:      1.49MB

# FPM with database
Running 5s test @ http://web:8080/users
  16 threads and 100 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency   779.68ms  243.37ms   1.55s    70.42%
    Req/Sec     9.10      5.95    30.00     71.49%
  Latency Distribution
     50%  796.43ms
     75%  922.04ms
     90%    1.07s
     99%    1.42s
  568 requests in 5.10s, 2.64MB read
Requests/sec:    111.41
Transfer/sec:    529.40KB

# Swoole with database
Running 5s test @ http://web/users
  16 threads and 100 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency    46.45ms   22.58ms 165.81ms   74.93%
    Req/Sec   131.17     40.70   424.00     71.32%
  Latency Distribution
     50%   41.85ms
     75%   56.58ms
     90%   77.76ms
     99%  124.32ms
  10585 requests in 5.10s, 49.25MB read
Requests/sec:   2075.82
Transfer/sec:      9.66MB

```
<p align="center">
  <img src="./public/assets/bench.jpg" width="350" title="benchmark">
</p>


## Go up environment


```sh
make start
```

Access `app` container
```sh
docker exec -it symfony-swoole-php-app-1 bash
```

Run the seeds
```sh
php bin/console doctrine:fixtures:load
```


## References

* To install the swoole I used [this package](https://github.com/php-runtime/swoole)

