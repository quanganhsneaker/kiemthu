services:
    - type: web
      name: teddy-laravel
      env: docker
      plan: free
      region: oregon
      dockerfilePath: ./Dockerfile
      envVars:
        - key: APP_ENV
          value: production
        - key: APP_KEY
          generateValue: true
        - key: APP_DEBUG
          value: false
        - key: DB_CONNECTION
          value: sqlite

          