#/bin/bash

echo "Deleteing..."
find /etc/bind -type f -name "spoof.*" -print0 | xargs -0 \echo
find /etc/bind -type f -name "spoof.*" -print0 | xargs -0 \rm


echo ""
echo "Wiping /etc/bind/named.conf.local..."
sed '/####################/q' /etc/bind/named.conf.local | sudo tee /etc/bind/named.conf.local > /dev/null

echo ""
echo "Delete and Wiping Completed!"

echo ""
echo "Restarting bind9..."
systemctl restart bind9
sleep 5
systemctl start bind9
echo "Restart complete"
