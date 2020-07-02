# Changelog

## 2.3.0 - July 2 2020

- User request will not enforce user registration validation if someone is auth'd, enabling the use of the registration workflow of new places for registered users on Ultra.

## 2.2.0 - June 29 2020

- User model will default its connection to "mysql" as per config, but this value can be changed using and environment variable.

## 2.1.1 - June 25 2020

- Added postal code validation package.
- Added phone validation package.

## 2.1.0 - June 25 2020

- Added requests to validate places in public registrations / addition of places.
- Added requests to validate places for user registration that occurs on ultra locale versions.

## 2.0.0 - June 25 2020

- Changed name of scope applied to Place model to better differentiate with other new scopes.
- Scopes RCM and Region to the value set in config / env if ultra locale version is enabled.

## 1.3.0 - June 25 2020

- Added a `soloc-commons.ultra-local.region_ids` config value linked to a `SOLUTION_LOCALE_ULTRA_REGION_IDS` environment variable.

## 1.2.0 - June 18 2020

- Added relationship method to link a RMC to a place.

## 1.1.0 - June 17 2020

- Added scoping for ultra local sites, with appropriate trigger for enabling it.

## 1.0.0 - June 17 2020

- Added configuration file.
- Added filters.
- Added models.
- Added observers.
- Added services.
- Addes sorters (a.k.a "utils").
