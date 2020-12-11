#!/bin/bash

lftp -c "set ftp:list-options -a;
open ftp://$BUNNYCDN_USERNAME:$BUNNYCDN_PASSWORD@storage.bunnycdn.com;
lcd public
mirror --reverse --delete --use-cache --verbose --allow-chown --parallel=2"
