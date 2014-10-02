#!/bin/sh

source config.sh

${DIR}mysqldump -h$HOST -u$USER $DB > ${DB}.sql
