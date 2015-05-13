#!/usr/bin/env bash

LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/opt/sqlanywhere16/lib64
export LD_LIBRARY_PATH
php /var/www/sida/cmd/sync.php
