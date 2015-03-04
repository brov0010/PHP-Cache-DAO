#! /bin/bash

brew update
brew doctor
#brew install memcached
#brew install php53-memcache

echo -n "Enter the mysql user account and press [ENTER]: "
read user
echo -n "Enter the mysql user password and press [ENTER]: "
read pw

mysql -u $user -p$pw < ../sql/dao_test.sql
echo "Added the dao_test database"
