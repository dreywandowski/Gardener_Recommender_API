<p align="center"><a href="https://ouredenlife.com/" target="_blank"><img src="https://dreywandowski.xyz/images/eden-logo_lcepc6.svg" width="350" height="150"></a></p>

<p align="center">
<a href="#"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="#"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="#"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="#"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Gardener_Recommender_API

An API to onboard new customers looking to have access to Eden's conceirge services by taking their details and assigning them to gardeners within their geographic regions.
 
 Documentation available at: https://documenter.getpostman.com/view/11897292/UVkqrEdv#cd8b3eb0-4e07-4f54-8230-7c4827ceda7c
 
 
 Live Link available: http://ameka-art.tk/api/
 
 The API has been optimized to implement server-side caching using the file method to cache read requests from the server.
 
 This cache lasts for 10 minutes before the server makes a fresh database check for new requests.
 
 If you however wish to run locally:
- Clone the project 
- Run Migrations to get the database structure
- Run seeding to get some dummy data copied
- Import the sql files (users.sql and locations.sql) to your db to get some other changes like db structure
and default values.
