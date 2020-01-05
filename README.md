**Star Wars Web Service**
-
This repository contains a `Symfony` project acts as a web service and provides open API
to consume star wars statistics.

**Download Project**

`Clone the repository to your local directory`

`cd my-projec/`

**Project Setup**
```
composer install
```
**Project Start**

It should being served on `http://127.0.0.1:8000/`
```
 symfony server:start
```

**Project Configuration**

please add your own parameters to these file `.env`, `.env.environment` 

if you want to update the database config or other used parameters.

**Important Routes**

`/graphiql` useful GUI to apply `Graphql` queries and mutations.

`/api/doc` good APIs documentation 