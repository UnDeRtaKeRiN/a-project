<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Kundennummer:       {$Form->getSubmitValue('customerid')}<br>
    Ansprechpartner:    {$Form->getSubmitValue('saluation', 'prename', 'surname')}<br>
    Emailadresse:       {$Form->getSubmitValue('email')}<br>
    Themenbereich:      {$smarty.post.ticketform.ticketqueue}<br>
    Kategorie:          {$smarty.post.ticketform.category}<br>
    Unterkategorie:      {$smarty.post.ticketform.category}<br>
    Kundennachricht:<br>
    {$Form->getSubmitValue('ticketmessage')}
</body>
</html>