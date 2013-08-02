Mailgun - Stats
====================

This is the Mailgun PHP *Stats* endpoint. 

The below assumes you've already installed the Mailgun PHP SDK in to your project. If not, go back to the master README for instructions.

Usage
-------------
Here's how to use the "Stats" API endpoint:

```php
# First, instantiate the client with your PUBLIC API credentials and domain. 
$mgClient = new MailgunClient("pubkey-5ogiflzbnjrljiky49qxsiozqef5jxp7", "samples.mailgun.org");

# Next, instantiate a Stats object on the Stats API endpoint.
$stats = $mgClient->Stats();

# Next, get the last 50 stats.
$stats->getStats(50, 0);
```

Available Functions
-------------------

`deleteTag(string $tag)`  

`getStats(int $limit, int $skip)`  

More Documentation
------------------
See the official [Mailgun Docs](http://documentation.mailgun.com/api-stats.html) for more information.