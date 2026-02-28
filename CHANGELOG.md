# Changelog

All notable changes to `laravel-cashregister-bridge` will be documented in this file.

## 5.0.0 - 2026-02-28

### What's Changed

* Bump dependabot/fetch-metadata from 2.2.0 to 2.3.0 by @dependabot[bot] in https://github.com/etsvThor/laravel-cashregister-bridge/pull/26
* Bump dependabot/fetch-metadata from 2.3.0 to 2.4.0 by @dependabot[bot] in https://github.com/etsvThor/laravel-cashregister-bridge/pull/27
* Bump actions/checkout from 4 to 6 by @dependabot[bot] in https://github.com/etsvThor/laravel-cashregister-bridge/pull/31
* Bump dependabot/fetch-metadata from 2.4.0 to 2.5.0 by @dependabot[bot] in https://github.com/etsvThor/laravel-cashregister-bridge/pull/32
* Bump stefanzweifel/git-auto-commit-action from 5 to 7 by @dependabot[bot] in https://github.com/etsvThor/laravel-cashregister-bridge/pull/30
* Bump Laravel requirements to 11
* Allow Laravel 12

**Full Changelog**: https://github.com/etsvThor/laravel-cashregister-bridge/compare/4.1.5...5.0.0

## 4.1.5 - 2024-10-27

### What's Changed

* Fix getExternalProductItem for softdeletes models by @ThijsLacquet in https://github.com/etsvThor/laravel-cashregister-bridge/pull/25

**Full Changelog**: https://github.com/etsvThor/laravel-cashregister-bridge/compare/4.1.4...4.1.5

## 4.1.4 - 2024-09-04

### What's Changed

* Fix by @ThijsLacquet in https://github.com/etsvThor/laravel-cashregister-bridge/pull/24

**Full Changelog**: https://github.com/etsvThor/laravel-cashregister-bridge/compare/4.1.3...4.1.4

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
