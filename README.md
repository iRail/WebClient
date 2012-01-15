# iRail

This is the WebClient hosted at [http://iRail.be]. Unstable versions can be found at [http://dev.iRail.be] (bleeding edge). It's built upon the iRail api ([http://api.iRail.be]) which delivers public transport information to online applications, free of charge and free as in beer.

This is the WebClient 2.0 branch. The design has been made by Dennis Kestelle. People who brought this client to life:

 * Muhammet "Mojo" Kilic <muhammet aŧ zeropoint.IT>
 * Pieter Colpaert <pieter aŧ iRail.be>

More information can be found on [Project iRail](http://project.irail.be/).

# License

This branch has been written from scratch and therefor relicensed to: AGPL

(c) 2012 iRail vzw/asbl

# Developers

Check the DEVELOPERS file

# Installation

Adjust config.php to your needs and copy the entire repository to your server.

You need:

 * PHP5
 * url rewrite mod
 * http request

# Translations

All translation files are located in `i18n/`, contain a PHP translation array, and should adhere to the `xx.php` format.

Note: the `en.php` file is a treated in a special way. It is used as the source for all other translations, so whenever a string in the code is change this file _must_ be updated to reflect those changes. See below for the syncing procedure.

## Syncing with Transifex

We are using http://transifex.net as a frontend for translating the client, use the [Transifex client](http://help.transifex.net/features/client/index.html) to fetch new translations from Transifex.

### Pushing new source strings

1. Update `i18n/en.php` to reflect the changes
2. `tx push -s`

### Fetching new translations

1. `tx pull -a`
2. `git add` new translations from `i18n/`

# Some interesting links:

 * Source: <http://github.com/iRail/iRail>
 * Mailing: <http://list.irail.be/>
 * Trac: <http://project.irail.be/>
 * API: <http://api.irail.be/>
 * BeTrains: <http://betrains.mobi/>
