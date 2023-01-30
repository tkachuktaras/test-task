<style>
    .code {
        margin: 15px 0;
        padding: 5px;
        background: #dedede;
    }
</style>

<div class="container">
    <div class="mt-5 mb-5">
        <h3 class="integration-content-header">
            Documentation
        </h3
    </div>

    <div id="inventories-update" class="example">

        <table class="table table-operations">
            <tbody>
            <tr class="operation operation-post">
                <th>POST/GET</th>
                <td><?php echo url('/api/random_survey/')?></td>
                <td class="text-right"><i>Get Random Survey</i></td>
            </tr>
            </tbody>
        </table>

        <p class="text-bold mb5"> <b>Sample POST request to Get Random Survey:</b></p>

        <div class="code">
        <pre>
POST <?php echo url('/api/random_survey/')?><br>

Example response:
{
    "title": "Message: ini_set(): A session is active. You cannot change the session modules ini settings at this time",
    "status": "active",
    "created_at": "2023-01-30 10:58:51",
    "answers": [
        {
            "text": "You need to alias the subquery.  SELECT name FROM (SELECT name FROM agentinformation) a  ",
            "votes": 2
        },
        {
            "text": "The message means that you have started a session with session_start() in which further down in the code you are using ini_set() to manipulate the session module. If you are manipulating the session module, it should be done before a session is started and active.",
            "votes": 0
        }
    ]
}
        </pre>
        </div>

    </div>

        <h3 class="integration-content-header">
            Sample request on PHP
        </h3>

        <div class="code">
        <pre>
&lt;?php
    $url = "<?php echo url('/api/random_survey/')?>";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($curl, CURLOPT_HTTPHEADER, []);

    $resp = curl_exec($curl);
    curl_close($curl);
    var_dump($resp);
?&gt;
        </pre>
        </div>

        <h3 class="integration-content-header">
            Sample request on Python
        </h3>

        <div class="code">
        <pre>
import requests
from requests.structures import CaseInsensitiveDict

url = "<?php echo url('/api/random_survey/')?>"

headers = CaseInsensitiveDict()

resp = requests.get(url, headers=headers)
print(resp.content)
        </pre>
        </div>

        <h3 class="integration-content-header">
            Sample request on Node.js
        </h3>

        <div class="code">
        <pre>
const request = require('request');

const options = {
    url: <?php echo url('/api/random_survey/')?>,
    method: 'POST',
};

function callback(error, response, body) {
    console.log(body)
}

request(options, callback);

        </pre>
        </div>

    </div>

</div>