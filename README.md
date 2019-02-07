La Boutique Officielle - Pokedex challenge
========================

# Overview

Thanks for taking time to do this little test. The aim of this technical test is to gauge mostly your approach to writing code.

And, since our clients are asking for a Pokedex feature for a while now, that's seems to be the perfect subject for this test !

We are looking for:
- Clean and concise code
- Unit tests
- Highly maintainable code
- Self documented code

# Installation

- Clone the repo

        $ git clone git@github.com:laboutiqueofficielle/pokedex.git
- Configure the "parameters.yml" with you database information
- Create the database
        
        $ php bin/console doctrine:database:create
- Create the tables

        $ php bin/console doctrine:schema:update --force
        
# Tasks

## Configuring Asserts

We have a model "Pokemon", but since we do want to have a way to validate our objects, you have to write all needed Asserts on this model

## Populating Database

A "pokemons.csv" file exist in this repository. The first tasks is to create a Symfony's command to import this data to our database.

The command should be runnable by 
        
    php bin/console lbo:pokedex:import --path ./pokemons.csv
    
###Constraints
- Execution ime should be measured and displayed into the console, and logged
- Monolog must be used to log data (https://symfony.com/doc/3.4/logging.html)
- If a line contains an error, it should be documented, and import should continue 
    
    
## Creating a Rest API

For this, we recommend that you use this libs (use composer to install it):
- JMS Serializer: https://github.com/schmittjoh/JMSSerializerBundle
- FosRestBundle: https://github.com/FriendsOfSymfony/FOSRestBundle

Now that we have data in our DB, we need a way to get this data.

### Get all Pokemon by species ID

    GET: http://localhost:8000/pokedex/species/{speciesId}
This route should return ALL pokemon of the given species, but only the default one.
To do so, we want you to write a custom DQL

    POST: http://localhost:8000/pokedex/add
This route should add a Pokemon into our Database

## Submit your work

We do work as a team, so every piece of code is reviewed by a fellow coder.

A Pull Request from your branch to "develop" must be submitted.

Feel free to use this to explain to us your approach, the problems you encountered or any feedback you want.
