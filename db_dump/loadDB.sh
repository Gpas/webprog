#!/bin/sh

source config.sh

${DIR}mysql -u$USER $DB < ${DB}.sql
