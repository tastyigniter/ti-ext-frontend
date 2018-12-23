subject = "Contact on {site_name}"
==

Someone just contacted you!

Hi there,

Here is your form:

Name: {full_name}
Subject: {contact_topic}
E-mail: {contact_email}
Telephone: {contact_telephone}
Message: {contact_message}

This inquiry was sent from {site_name}.

==

<!-- HEADER -->
<table class="head-wrap" bgcolor="#D7D7DE">
    <tr>
        <td></td>
        <td class="header container">
            <div class="content">
                <table bgcolor="#D7D7DE">
                    <tr>
                        <td><img src="{site_logo}"/></td>
                        <td align="right"><h6 class="collapse">{site_name}</h6></td>
                    </tr>
                </table>
            </div>
        </td>
        <td></td>
    </tr>
</table><!-- /HEADER -->
<!-- BODY -->
<table class="body-wrap">
    <tr>
        <td></td>
        <td class="container" bgcolor="#FFFFFF">
            <div class="content">
                <table>
                    <tr>
                        <td>
                            <h3>Someone just contacted you!</h3>
                            <p class="lead">Hi Admin,</p>
                            <p>Here is your form.</p>
                            <table class="contact">
                                <tr>
                                    <td width="163"><strong>From</strong></td>
                                    <td width="397">{full_name}</td>
                                </tr>
                                <tr>
                                    <td><strong>Subject</strong></td>
                                    <td>{contact_topic}</td>
                                </tr>
                                <tr>
                                    <td><strong>E-mail</strong></td>
                                    <td>{contact_email}</td>
                                </tr>
                                <tr>
                                    <td><strong>Telephone</strong></td>
                                    <td>{contact_telephone}</td>
                                </tr>
                                <tr>
                                    <td><strong>Message</strong></td>
                                    <td>{contact_message}</td>
                                </tr>
                            </table>
                            <br>
                            <p>This inquiry was sent from {site_name}.</p>
                        </td>
                    </tr>
                </table>
            </div><!-- /content -->
        </td>
        <td></td>
    </tr>
</table><!-- /BODY -->