<html xmlns="">
<head>
    <meta http-equiv="Content-Type" content=text/html; charset=UTF-8"/>
    <title>Mauve System3 Ticketsystem</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h2>Willkommen im Mauve System3 Ticketsystem</h2>
            <p class="lead">Zum Erstellen eines Tickets bitte das Formular ausfüllen und absenden.</p>

            <div class="col-sm-9 col-sm-offset-3">
                {if $validation->getErrors()}
                    <ul>
                        {foreach $validation->getErrors() as $key => $errorMessage}
                            <li>
                                <p>{$errorMessage}</p>
                            </li>
                        {/foreach}
                    </ul>
                {/if}
            </div>

            <form action="index.php" method="post" class="form-horizontal">

                <div id="name-wrap" class="form-group">
                    <label for="salutation" class="col-sm-3 control-label">Anrede <sup>(*)</sup></label>
                    <div class="col-sm-4">
                        <select name="ticketform[salutation]" class="form-control">
                            <option value="">Auswählen...</option>
                            <option value="Frau"{if $validation->getSubmitValue('salutation') == 'Frau'} selected{/if}>
                                Frau
                            </option>
                            <option value="Herr"{if $validation->getSubmitValue('salutation') == 'Herr'} selected{/if}>
                                Herr
                            </option>
                        </select>
                    </div>
                </div>

                <div id="name-wrap" class="form-group">
                    <label for="prename" class="col-sm-3 control-label">Vorname <sup>(*)</sup></label>
                    <div class="col-sm-4">
                        <input type="text" id="prename" name="ticketform[prename]" class="form-control"
                               value="{$validation->getSubmitValue('prename')}" tabindex="1"/>
                    </div>
                </div>

                <div id="name-wrap" class="form-group">
                    <label for="surname" class="col-sm-3 control-label">Nachname <sup>(*)</sup></label>
                    <div class="col-sm-4">
                        <input type="text" id="surname" name="ticketform[surname]" class="form-control"
                               value="{$validation->getSubmitValue('surname')}" tabindex="2"/>
                    </div>
                </div>

                <div id="email-wrap" class="form-group">
                    <label for="email" class="col-sm-3 control-label">E–Mail <sup>(*)</sup></label>
                    <div class="col-sm-4">
                        <input type="text" id="email" name="ticketform[email]" class="form-control"
                               value="{$validation->getSubmitValue('email')}"
                               tabindex="3"/>
                    </div>
                </div>

                <div id="name-wrap" class="form-group">
                    <label for="customerid" class="col-sm-3 control-label">Kundennummer </label>
                    <div class="col-sm-4">
                        <input type="text" id="customerid" name="ticketform[customerid]" class="form-control"
                               value="{$validation->getSubmitValue('customerid')}" tabindex="4"/>
                    </div>
                </div>

                <div id="name-wrap" class="form-group">
                    <label for="ticketqueue" class="col-sm-3 control-label">Themenbereich <sup>(*)</sup></label>
                    <div class="col-sm-4">
                        <select name="ticketform[ticketqueue]" class="form-control" onchange="this.form.submit();">
                            <option value="">Auswählen...</option>
                            {foreach $queues as $queue}
                                <option value="{$queue.queue_id}"{if isset($smarty.post.ticketform.ticketqueue) && $smarty.post.ticketform.ticketqueue == $queue.queue_id} selected{/if}>
                                    {$queue.name}
                                </option>
                            {/foreach}
                        </select>
                    </div>
                </div>

                <div id="name-wrap" class="form-group">
                    <label for="category" class="col-sm-3 control-label">Kategorie </label>
                    <div class="col-sm-4">
                        <select name="ticketform[category]" class="form-control" {if ! isset($smarty.post.ticketform.ticketqueue) || ! $smarty.post.ticketform.ticketqueue}disabled{/if} onchange="this.form.submit();">
                            <option value="">Auswählen...</option>
                            {foreach $categories as $category}
                                <option value="{$category.category_id}"{if isset($smarty.post.ticketform.category) && $smarty.post.ticketform.category == $category.category_id} selected{/if}>
                                    {$category.name}
                                </option>
                            {/foreach}
                        </select>
                    </div>
                </div>

                <div id="name-wrap" class="form-group">
                    <label for="topic" class="col-sm-3 control-label"> </label>
                    <div class="col-sm-4">
                        <select name="ticketform[topic]" class="form-control" {if !(isset($smarty.post.ticketform.category) && $smarty.post.ticketform.category)}disabled{/if}>
                            <option value="">Auswählen...</option>
                            {foreach $topics as $topic}
                                <option value="{$category.topic_id}"{if isset($smarty.post.ticketform.topic) && $smarty.post.ticketform.topic == $topic.topic_id} selected{/if}>
                                    {$topic.name}
                                </option>
                            {/foreach}
                        </select>
                    </div>
                </div>

                <div id="name-wrap" class="form-group">
                    <label for="subject" class="col-sm-3 control-label">Betreff <sup>(*)</sup></label>
                    <div class="col-sm-4">
                        <input type="text" id="subject" name="ticketform[subject]" class="form-control"
                               value="{$validation->getSubmitValue('subject')}" tabindex="5"/>
                    </div>
                </div>

                <div id="name-wrap" class="form-group">
                    <label for="ticketmessage" class="col-sm-3 control-label">Ihre Nachricht <sup>(*)</sup></label>
                    <div class="col-sm-4">
                        <textarea id="ticketmessage" name="ticketform[ticketmessage]" rows="7" cols="55"
                                  placeholder="Bitte beschreiben Sie Ihr Problem so genau wie möglich."
                                  value="{$validation->getSubmitValue('ticketmessage')}" tabindex="6"></textarea>
                    </div>
                </div>

                <div id="button-wrap" class="form-group">
                    <div class="col-sm-4 col-sm-offset-3">
                        <input type="submit" name="ticketSend" value="Absenden"/>
                        <input type="submit" name="ticketAbort" value="Abbrechen"/>
                    </div>
                </div>

                <div id="hinweis-wrap" class="form-group">
                    <div class="col-sm-3 col-sm-offset-3">
                        <em><sup>(*)</sup> Pflichtfelder</em>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-4">
            <form action="index.php" method="post" class="form-horizontal">
                {if !$hideCode}
                    <h2>Loginbereich</h2>
                    <p class="lead">Loggen Sie sich hier ein, um das Formular mit Ihren hinterlegten Daten
                        vorzufüllen.</p>
                    <div class="">
                        {if $loginvalidation->getErrors()}
                            <ul>
                                {foreach $loginvalidation->getErrors() as $key => $errorMessage}
                                    <li>
                                        <p>{$errorMessage}</p>
                                    </li>
                                {/foreach}
                            </ul>
                        {/if}
                    </div>

                    <div>
                        {if $nologin}
                            <ul>
                                <li>
                                    <p>Benutzername oder Passwort falsch.</p>
                                </li>
                            </ul>
                        {/if}
                    </div>

                    <div id="name-wrap" class="form-group">
                        <label for="username" class="">Benutzername</label>
                        <div class="">
                            <input type="email" id="username" name="loginform[username]" class="form-control"
                                   value="{$loginvalidation->getSubmitValue('username')}" tabindex="1"
                                   placeholder="Emailadresse"/>
                        </div>
                    </div>

                    <div id="name-wrap" class="form-group">
                        <label for="password" class="">Passwort</label>
                        <div class="">
                            <input type="password" id="password" name="loginform[password]" class="form-control"
                                   value="{$loginvalidation->getSubmitValue('password')}" placeholder="Passwort" tabindex="1"/>
                        </div>
                    </div>

                    <div id="button-wrap" class="form-group">
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="submit" name="loginform[submitted]" value="Login"/>
                        </div>
                    </div>
                {/if}
                {if $hideCode}
                    <h2>Loginbereich</h2>
                    <p class="lead">Ihre Daten wurden durch die Angabe Ihrer Benutzerdaten bereits übernommen.</p>
                {/if}
            </form>
        </div>
    </div>
</div>
</body>
</html>