name: Deploy

# Trigger the workflow on push and 
# pull request events on the production branch
on:
  push:
    branches:
      - production
  pull_request:
    branches:
      - production
      
# Authenticate to the the server via ssh 
# and run our deployment script 
jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Deploy to server
        uses: appleboy/ssh-action@master
        with:
          host: ${{ secrets.HOST }}
          username: ${{ secrets.USERNAME }}
          port: ${{ secrets.PORT }}
          key: ${{ secrets.SSHKEY }}
          script: "cd /var/www/html && ./.scripts/deploy.sh"
