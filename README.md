![SE Tradehouse Logo](https://github.com/mrdatawolf/Colonization/blob/master/public/images/SETradeHouse_logo_core.png?raw=true)
# SE TradeHouse [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Tradehouse for Space Engineers - is a standalone web service allowing a user to see trade data for perticipating Space Engineers (SE) Servers.  The goal is to display data to help a user smartly position themselves in their choosen SE Server's markets. Whether the user is running their own trades or are simply looking to maximze their profits; this system will help them understand the market forces in play and give guidance on the setting up the best trade positions.
 
##Quick Start (for local development and testing)
1. You need php on your system.  At a command prompt run `php -v`
You are expecting to see something like
 `PHP 7.1.8 (cli) (built: Aug  1 2017 20:56:32) ( NTS MSVC14 (Visual C++ 2015) x64 )
 Copyright (c) 1997-2017 The PHP Group
 Zend Engine v3.1.0, Copyright (c) 1998-2017 Zend Technologies`
    1. If you don't you might need to get php installed on your system. Checkout http://php.net
2. You might have to edit the php.ini and uncomment `extension=php_pdo_sqlite.dll` to use the sqlite db (this saves us from having to also install a full SQL for local work on the code).
3. You need a copy of the code.  If you just want to check it out you can goto https://github.com/mrdatawolf/Colonization and use the "Clone or Download" button.  Otherwise you will need to clone it so you can begin working on it and make pull requests.
4. In the main directory you need to run "composer update" <-- this might mean you need to install composer.
5. To start the server for local development go into the folder you saved it to and run localWeb.bat (Windows).
6. Open a web browser and goto `http://localhost:8282`.  You should see simple set of links at the top of the page.


##Current Roadmap
Road to 1.0 MVP
1. ~~Setup a sqlite database to be able to develop against.~~
2. ~~Populate the db with base values that are not built from other data.  This is the constants i the game like server refinery efficiency.~~
3. ~~Make a frontend for developers to see the current DB data.~~ see rawdata link
4. ~~Make a clone of the spreadsheet we have been using.~~
5. ~~Create all the code needed to derive the numbers shown on the spreadsheet.~~
6. ~~Align all values to the current spreadsheet as a proof that the system is working.~~
7. Get the spreadsheet page to allow the trade station amounts/values to be created/updated as needed (for testing).
8. Get the API fully functional for ingesting data and allowing call to view the data.  This API should stay in sync with the internal ablities.
9. ~~Bring it up on a server online.~~
10. Setup examples, with matching data, explaining how the system works.
11. Open it up so anyone can interact with the test system.
12. Verify SQL files can bring a basic version of the system up.

##Future Roadmap
1.  Revised +1.0 goals.
    1. Expand the active and inactive transactions to use all columns.
    2. Add weights to transactions based on distances from server to server.
    3. Improve the user system.
    4. Add sheets as needed to flex out the user experience. Anything that can help the users visualize or work with the data.
    5. Begin gathering the data from a live system to update the tradehouse with real world data.
    6. A Map Generator showing cluster servers and their tradezones. Or maybe just a common format for making a diagram for the users.
    7. There's alot more but it will depend on where we see the project going from here.

##Notes on the foundational logic we are shooting for...
![Clusters Example](https://raw.githubusercontent.com/mrdatawolf/Colonization/master/clusters_example.png)
#How a given item gets it's value for a trade-zone:
notes: cluster 1 is 1 server with 1 tradezone. cluster 2 is 10 servers, 4 of which have tradezones.  See image for layouts.
notes: A trade zone influences and is influenced by all the other trade-stations in the cluster (as long as there is any path to and/or from the other trade-stations. The amount of influence trade-stations have on each other is expressed as a "weight" for a given station.  Right now weight is based on how long they have been in system.
notes: We have moved to a tradehouse model.  So we look at the buy and sell orders in the tradezone, server, cluster.
1. Example 1:  In cluster 1 server 1 we have a tradestation (tz3) looking for 1,000,000 gold ore at 300 SC per. Because that is the only order we see the numbers reproduced in the server and cluster level. There is some wiggle room at the server and cluster level because of the math being done.
2. Example 2: Still in Nebulon Cluster on tz3 we see them selling 1,000,000 nickel ore at 80 SC per. Again you will see the stable numbers because this is the only order. But this time they are negative values because it's a sell order.
3. Example 3: Normally this would be... weird but if you had both a sell order and a buy order at the same tradestation for the same thing (platinum ore here) we take the ore buy order(s) and subtract the ore sell order to get the desire.  We had 30k in sell orders and 20k in buy orders. So we end up with a negative 10k desire. We also have a sell price of 250 and a buy of 200.  Since there are 10k more at the 250 price the "Average SC" is 5 higher (at 230) then a simple avg of the total Amount/Number of trades.
