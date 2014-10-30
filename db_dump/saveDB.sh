#!/bin/sh

source config.sh

${DIR}mysqldump --add-drop-database -h$HOST -u$USER --databases $DB > ${DB}.sql
