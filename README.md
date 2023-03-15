# Laravel Presentation Domain
My Customized Presentation and Domain layers for Laravel

## About
Presentation layer is primarily responsible for receiving requests and returning responses.  
Domain layer is primarily responsible for business logic.  
This package simplifies implementation of a customized data layer for Laravel.  
Also included is a View template for Admin Panel using Bootstrap5, as well as templates using Javascript and Sass.

## Presentation layer Details
Presentation layer is mainly responsible for following three processes
1. Receiving Request
2. Validation of Request
3. Returning Response

CRUD processing to database and various business logic should not be handled at Presentation layer.

### Controller
Controller is entry point for all requests and exit point for all responses.  
also, Controller is command post that controls which Forms are used for validation and which methods of Service are used for processing.

### Form
Form is primarily responsible for validating requests received by Controller.  
Unlike FormRequest, it is intended to be used as a data transfer object between Controller and Service by setting each property to Form in advance and assigning it to each property in bind method.


## Domain layer Details
### Service
Service implements various business logic tied to Controller.  
Also, database access via Model and Repository is performed only by Service.  
Since it tends to be a "Fat Service", it is recommended that parts that can be shared be written in BaseService or implement your own Helper.

## Installation
You can install package via composer:
```
composer require takeru-yamamoto/laravel-presentation-domain
```

## Usage
### Use of Template Publishing Command
```
php artisan vendor:publish --tag=mycustom-pd
```
Using this command in CLI will expose following files.  
Controller and Service should be used by extending base class.
* app/Http/Controllers/BaseController.php: Base Controller that includes ControllerTraits in addition to existing Controller
* app/Services/BaseService.php: Base Service with ServiceTraits inside
* lang/*: Language files used in application
* resources/js/mycustom.js: Access js template under vendor
* resources/js/functions.js: Access js functions template
* resources/sass/mycustom.scss: Access sass template under vendor
* package-require.json: Node packages required when using View templates

### Use View Templates
1. Copy and paste packages in package-require.json into package.json
2. Include resources/js/mycustom.js within resources/js/app.js
3. Include resources/sass/mycustom.scss within resources/sass/app.scss
4. Confirm that app.js and app.scss are written in input in vite.config.js and run "npm install && npm run dev"

Please check under src/resources/views of this package for available page templates and components.  
Page templates and components can be used with following descriptions.
```
@extends('mycustom::{template or component name}')
```