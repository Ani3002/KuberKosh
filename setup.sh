#!/bin/bash

# Define user information for GPG Key
user_name="yourName"                 # Change this to your actual Name
user_email="your.email@example.com"  # Change this to your actual email

# If you do not want to set up the GPG key comment out or remone line no 67 to 84.


### Installing softwares from parrot repo
sudo apt-get install gdebi nodejs npm


### Installing docker CLI

# Remove conflicting packages
for pkg in docker.io docker-doc docker-compose podman-docker containerd runc; do sudo apt-get remove $pkg; done

# Add Docker's official GPG key:
sudo apt-get update
sudo apt-get install ca-certificates curl
sudo install -m 0755 -d /etc/apt/keyrings
sudo curl -fsSL https://download.docker.com/linux/debian/gpg -o /etc/apt/keyrings/docker.asc
sudo chmod a+r /etc/apt/keyrings/docker.asc

# Add the repository to Apt sources:
echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/debian \
  bookworm stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update

sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

sudo docker run hello-world

### Install docker Desktop
ani=$(whoami)
if [ -d "/home/$ani/Downloads/initialSetup/tmp" ]; then
    echo "Directory already exists. Changing into the directory: ``/home/$ani/Downloads/initialSetup/tmp``"
    cd "/home/$ani/Downloads/initialSetup/tmp"
else
    echo "Directory does not exist. Creating and changing into the directory."
    mkdir -p "/home/$ani/Downloads/initialSetup/tmp" && cd "/home/$ani/Downloads/initialSetup/tmp"
fi

echo "Downloading Docker Desktop..."
url="https://desktop.docker.com/linux/main/amd64/137060/docker-desktop-4.27.2-amd64.deb?utm_source=docker&utm_medium=webreferral&utm_campaign=docs-driven-download-linux-amd64"

# Extracting the file name from the URL
file_name=$(basename "$url" | cut -d '?' -f 1)

# Downloading and directly saving with the desired filename
wget "$url" -O "$file_name"

echo "Downloaded file saved as $file_name."

echo "Updating System"

sudo apt-get update
ls
echo "Installing docker with `` gdebi cli `` "

sudo gdebi "$file_name"


# Generate GPG key in batch mode
gpg --batch --gen-key <<EOF
Key-Type: RSA
Key-Length: 3072
Name-Real: $user_name
Name-Email: $user_email
Expire-Date: 0
%no-protection
%commit
EOF

# Extract the key ID from the output
key_id=$(gpg --list-secret-keys --keyid-format LONG | awk '/sec/{print $2}' | cut -d'/' -f2)

# Print the key ID
echo "GPG Key ID: $key_id"

pass init $key_id