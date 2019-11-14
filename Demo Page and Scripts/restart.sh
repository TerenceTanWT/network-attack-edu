#/bin/bash

echo "Restarting bind9..."
systemctl restart bind9
sleep 5
systemctl start bind9
echo "Restart complete"
