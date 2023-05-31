### Multi-Tenant Bundle Example
This is a simple example of using the https://github.com/RamyHakam/multi_tenancy_bundle

That bundle is a simple way to add multi-tenancy to your Symfony application.

You can check the bundle's README.md for the features list and configurations.
### How To Use This Example 
1.  Clone The repo
2.  Set `DATABASE_URL` in your .env file
3.  Composer install `composer install`
4.  Create the main DB using `symfony console d:d:create`
5.  Migrate the current migration files to your main db using `symfony console d:m:m`
6.  Create a new tenant by calling `create-tenant` route,This will create add a new tenant db to tenantdbConfig entity
7.  Exceute `symfony console t:d:c  with $tenantdbName` to create and migrate the new database 
8.  Call `update-tenant-store` route to add a new store category to your new tenant Db       
