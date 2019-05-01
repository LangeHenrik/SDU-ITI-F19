#!/usr/bin/env bash

mysql --user=root --password=password --host=127.0.0.1 --database=bjtob17 < migrations/migration.sql
