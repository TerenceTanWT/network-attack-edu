#/bin/bash

domain=$1
ip=$2

##### Creating bind config #####
echo "" >> /etc/bind/named.conf.local
echo "zone\t\"${domain}\" {" >> /etc/bind/named.conf.local
echo "\ttype master;" >> /etc/bind/named.conf.local
echo "\tfile \"/etc/bind/spoof.${domain}\";" >> /etc/bind/named.conf.local
echo "};" >> /etc/bind/named.conf.local
echo "Bind config to /etc/bind/spoof.${domain} created..."
echo ""

##### Creating bind #####

cp /etc/bind/template /etc/bind/spoof.${domain}

sed -i -e "s/%DOMAIN/${domain}/g" /etc/bind/spoof.${domain}
sed -i -e "s/%IP/${ip}/g" /etc/bind/spoof.${domain}

echo ${domain} "successfully binded to" ${ip}
echo ""

##### Restart bind9 #####
echo "Restarting bind9..."
systemctl restart bind9
sleep 5
systemctl start bind9
echo ""

##### Show listening ports #####
echo "Listening Ports:"
lsof -i -P -n | grep LISTEN
