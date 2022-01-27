#!/bin/bash

/usr/local/bin/php /srv/app/bin/console app:crawl >> /var/log/cron.log 2>&1

echo "$(date): executed script" >> /var/log/cron.log 2>&1