# Changelog

All notable changes to `laravel-cashregister-bridge` will be documented in this file.

## 4.1.3 - 2024-08-08

### What's Changed

* Bump dependabot/fetch-metadata from 2.1.0 to 2.2.0 by @dependabot in https://github.com/etsvThor/laravel-cashregister-bridge/pull/22
* Allow get for cashregister.redirect route by @ThijsLacquet in https://github.com/etsvThor/laravel-cashregister-bridge/pull/23
* Add config option to push recently created product items on sync by @ThijsLacquet in https://github.com/etsvThor/laravel-cashregister-bridge/pull/23
* Make it possible to receive payments from trashed product items by @ThijsLacquet in https://github.com/etsvThor/laravel-cashregister-bridge/pull/23

**Full Changelog**: https://github.com/etsvThor/laravel-cashregister-bridge/compare/4.1.2...4.1.3

## 4.1.2 - 2024-07-04

### What's Changed

* Revert last changes partly by @niekbr in https://github.com/etsvThor/laravel-cashregister-bridge/pull/21

**Full Changelog**: https://github.com/etsvThor/laravel-cashregister-bridge/compare/4.1.1...4.1.2

## 4.1.1 - 2024-07-04

### What's Changed

* Ignore push if DTO is null by @niekbr in https://github.com/etsvThor/laravel-cashregister-bridge/pull/20

**Full Changelog**: https://github.com/etsvThor/laravel-cashregister-bridge/compare/4.1.0...4.1.1

## 4.1.0 - 2024-07-04

### What's Changed

* Fuck db permissions by @niekbr in https://github.com/etsvThor/laravel-cashregister-bridge/pull/19
* Pass DTO to job instead of model by @niekbr in https://github.com/etsvThor/laravel-cashregister-bridge/pull/18

!! If you dispatch the cash register sync jobs in your application, please pass the DTO instead of the model as job parameter.

**Full Changelog**: https://github.com/etsvThor/laravel-cashregister-bridge/compare/4.0.0...4.1.0

## 4.0.0 - 2024-06-26

### What's Changed

* Laravel 11 by @ThijsLacquet and @niekbr in https://github.com/etsvThor/laravel-cashregister-bridge/pull/17

**Full Changelog**: https://github.com/etsvThor/laravel-cashregister-bridge/compare/3.0.1...4.0.0

## 3.0.1 - 2024-04-30

### What's Changed

* Improve completed bool by @niekbr in https://github.com/etsvThor/laravel-cashregister-bridge/pull/14

**Full Changelog**: https://github.com/etsvThor/laravel-cashregister-bridge/compare/3.0.0...3.0.1

## V3.0.0 - 2024-04-29

### What's Changed

* Bump dependabot/fetch-metadata from 1.6.0 to 2.1.0 by @dependabot in https://github.com/etsvThor/laravel-cashregister-bridge/pull/12
* Set completed by @niekbr in https://github.com/etsvThor/laravel-cashregister-bridge/pull/13

**Full Changelog**: https://github.com/etsvThor/laravel-cashregister-bridge/compare/2.0.0...3.0.0
