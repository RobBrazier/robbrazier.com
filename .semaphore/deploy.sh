#!/bin/bash
ftp_url="ftp://$BUNNYCDN_USERNAME:$BUNNYCDN_PASSWORD@storage.bunnycdn.com"

cd public

mkdir -p bunnycdn_errors
mv 404.html bunnycdn_errors/

lftp "$ftp_url" -e "mirror --dry-run --reverse --delete; bye" > ../to-delete.txt

to_delete=$(grep rm ../to-delete.txt | awk -F"$BUNNYCDN_USERNAME/" '{ print $2 }')

lftp "$ftp_url" -e "mirror --reverse --verbose --parallel=2; bye"

lftp_command=""
for f in $to_delete; do
    lftp_command="rm -r $f; $lftp_command"
done
lftp "$ftp_url" -e "$lftp_command bye"
