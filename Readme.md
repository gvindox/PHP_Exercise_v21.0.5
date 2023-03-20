# Install

1. go to project directory
2. execute command `chmod +x startup.sh`
3. execute command `./startup.sh`

# Usage
The application will start and index page of localhost, with default port it will be http://127.0.0.1:80/. You can change a port in docker-compose.override.yaml

# What I didn 't have time to do and how would I do it

`3) Based on the Historical data retrieved, display on screen a chart of the Open and Close prices.`

I would use a Chart.js library and push information from php to js with json_encode by twig template, for example:
`<script>
    var historyRecords = {{ historyRecords|json_encode }}
</script>`


`Have 100% testing coverage. Backend and Frontend`

I would make 100% coverage for backend and frontend by unit tests and functional tests. Phpunit can make report to how good coverage is. 
For backend i would make tests even for form (what fields are in form, correct names of fields, correct type and so on) and also for repository too.
For frontend i would to use Jasmine or Jest framework.


`4) Send to the submitted Email an email message, using as:`
I would use a mailserver image for docker. Also i would make an interface for send notifications and make implementation of it by concrete email sender class, for example (with using a good symfony library symfony/mailer):

```
<?php 
interface Sender 
{
    public function send(string $sendTo, string $message, string $title): void;
}

class MailSender implements Sender
{
    public function __construct(private MailerInterface $mailer) {}
    
    public function send(string $sendTo, string $message, string $title): void 
    {
        $email = (new Email())
            ->from('test@test.com')
            ->to($sendTo)
            ->subject($title);
            
        $this->mailer->send($email);    
    }
}
```

`Validate the form both on client and server side`
I would use a jQuery to make form validate before send request to server. I would use datepicker library to validate date, jqueryvalidation library to validate email, and ajax request to backend to validate company symbol (it can be validated by js if we'll push information from php to twig, but it's a bad idea because there may be a 1mln rows or greater to search)

`2) Display on screen the historical quotes for the submitted Company Symbol in the given date range in table format. Table columns`
Date field of table i would format to 'Y-m-d' (2022-01-01), and also i would sort information by Date in Desc order. 

# Problems
`https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data problem`

The key for request is correct, request return a response with status code 200, but according to the task, it is necessary to filter information by date interval. There is no API documentation for get-historical-data in internet how set date interval, the one thing i found are fields "from" and "to", but it looks like `yh-finance.p.rapidapi` service doesn't handle this fields.
According to this problem i would make a filter by date interval in application, but there is a possibility that the information requested by the user for a certain time interval will be empty.
