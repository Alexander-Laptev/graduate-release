#!/bin/bash
set -e

echo "Deployment started ..."

git checkout production
git pull origin production

echo "Deployment finished!"
